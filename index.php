<?php 

session_start();
require_once "vendor/autoload.php";

use \Slim\Slim; 
use \Invent\Page;
use \Invent\Relacoes\Usuario;
use \Invent\Relacoes\Reagente;
use \Invent\Relacoes\Itens;
use \Invent\Mailer;
use \Invent\Dados;

date_default_timezone_set('America/Sao_Paulo');
$app = new Slim();
$app->config('debug', false); // Modo debug para visualizar erros. Pode retirá-lo no final.

// INÍCIO DE LOGIN
$app->get('/', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("login", ['erro'=>Usuario::getErro()]);
});

$app->post('/', function() {
	try{ 
		Usuario::acessar($_POST["email"],$_POST["senha"]);
		header("Location: /consulta");
		exit;			
	} catch (Exception $e) {
		Usuario::setErro($e->getMessage());
		header("Location: /");
		exit;		
	}	
});
// FIM DE LOGIN

//INÍCIO DE CADASTRO
$app->get('/cadastro', function() {	
	$listaCategorias = Itens::ListaCategoriasUsuario();	
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("cadastro", array("lista"=>$listaCategorias, "erro"=>Usuario::getErro()));
});

$app->post('/cadastro', function() {
	// Ainda falta colocar um sistema anti robô
	$usuarioCandidato = new Usuario();
	$usuarioCandidato->setDados($_POST);
	try {
		$validar = $usuarioCandidato->verificarEmail();
		$usuarioCandidato->salvar();



		$emailAdmin = Usuario::buscarEmailAdmin($usuarioCandidato->getlaboratorio());
		//var_dump($usuarioCandidato->getlaboratorio());
		//var_dump($emailAdmin);
		//var_dump(empty($emailAdmin));
		//exit;


		foreach($emailAdmin as $email){
			$mailer = new Mailer($email["email"], "Administrador", "Pedido de acesso ao InventárioRQ","email_ao_admin", array(
				"nome"=>$usuarioCandidato->getnome()." ".$usuarioCandidato->getsobrenome()
			));
			$mailer->send();
		}		
		$page = new Page(["header"=>false,"footer"=>false]);
		$page->setTpl("cadastro_realizado");
		header("refresh: 4; /");	
		exit;	
		
	} catch (Exception $e) {
		Usuario::setErro($e->getMessage());
		header("Location: /cadastro");
		exit;	
	}	
});
//FIM DE CADASTRO

//INÍCIO DO ESQUECEU A SENHA
$app->get('/esqueceu', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("esqueceu", ['erro'=>Usuario::getErro()]);
});

$app->post('/esqueceu', function() {
	try {
		Usuario::envioEsqueceuSenha($_POST["email"]);
		header("Location: /esqueceu/enviado");
		exit;			
	} catch (Exception $e) {
		Usuario::setErro($e->getMessage());
		header("Location: /esqueceu");
		exit;		
	}
});

$app->get('/esqueceu/reset', function() {
	try {		
		$usuarioRecup = Usuario::validarEsqueceuSenha($_GET["code"]);
		$page = new Page(["header"=>false,"footer"=>false]);
		$page->setTpl("esqueceu_reset", array("nome"=>$usuarioRecup["nome"], "code"=>$_GET["code"])); 
		exit;
	} catch (Exception $e) {
	Usuario::setErro($e->getMessage());
	header("Location: /");
	exit;
	}	
});

$app->post('/esqueceu/reset', function() {
	try {

		$usuarioRecup = Usuario::validarEsqueceuSenha($_POST["code"]);
		Usuario::registrarRecupSenha($usuarioRecup["idrecup_senha"]);
		$novoUsuario = new Usuario();
		$novoUsuario->setUsuarioId((int)$usuarioRecup["idusuario"]);
		$novoUsuario->atualizarSenha($_POST["senha"]);
		$page = new Page(["header"=>false,"footer"=>false]);
		$page->setTpl("esqueceu_reset", array("nome"=>$usuarioRecup["nome"], "code"=>$_POST["code"]));
		header("Location: /esqueceu/reset/sucess");
		exit;		
	} catch (Exception $e) {
		Usuario::setErro($e->getMessage());
		header("Location: /");
		exit;
	}	 
});

$app->get('/esqueceu/reset/sucess', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("esqueceu_sucess"); 
	header("refresh: 4; /");	
	exit;	
});

$app->get('/esqueceu/enviado', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("esqueceu_enviado"); 
	header("refresh: 4; /");	
	exit;	
});

$app->get('/esqueceu/email', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("esqueceu_email"); 	
});
//FIM DE ESQUECEU A SENHA

//INÍCIO DE USUÁRIOS
$app->get('/usuarios', function() {
	Usuario::verificarAcesso();
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$usuarios = Usuario::buscarUsuarios("situacao",1);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("usuarios", array("usuarios"=>$usuarios));	
});

$app->get('/usuarios/:idusuario', function($idusuario) {
	Usuario::verificarAcesso();
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$listaCategorias = Itens::ListaCategoriasUsuario();
	$usuario = new Usuario();
	$usuario->setUsuarioId((int)$idusuario);
	$usuario = $usuario->getDados();
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("usuario-update", array("usuario"=>$usuario, "lista"=>$listaCategorias));
});

$app->post('/usuarios/:idusuario', function($idusuario) {
	Usuario::verificarAcesso();
	$usuario = new Usuario();
	$usuario->setUsuarioId((int)$idusuario);
	if (!isset($_POST["tipo"])) {
		$_POST["tipo"]=2;
	}
	$usuario->setDados($_POST);
	$usuario->atualizarUsuario($idusuario);
	header("Location: /usuarios");
	exit;
});

$app->get('/usuarios/:idusuario/delete', function($idusuario) {
	Usuario::verificarAcesso();
	Usuario::deleteUsuario($idusuario);
	header("Location: /usuarios");
	exit;	
});
//FIM DE USUÁRIOS

// INÍCIO DE SOLICITAÇÃO DE USUÁRIOS
$app->get('/solicita', function() {
	Usuario::verificarAcesso();
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$usuarios = Usuario::buscarUsuarios("situacao",0);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("solicita", array("usuarios"=>$usuarios));	
});

$app->get('/solicita/:idusuario/aceito', function($idusuario) {
	Usuario::verificarAcesso();	
	Usuario::aceitarUsuario($idusuario);
	header("Location: /solicita");
	exit;	
});


$app->get('/solicita/:idusuario/delete', function($idusuario) {
	Usuario::verificarAcesso();
	Usuario::deleteUsuario($idusuario);
	header("Location: /solicita");
	exit;	
});

//FIM DE SOLICITAÇÃO DE USUÁRIOS

// INÍCIO DO GERENCIAMENTO DA SESSÃO "INCLUIR REAGENTES"

$app->get('/adicionar', function() {
	Usuario::verificarAcesso();
	$_SESSION[Dados::VOLTAR] = array("adicionar");	
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$listaCategorias = Itens::ListaCategoriasReagente();
	$categoria = Itens::buscaCategoriaEditar("localizacao");
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("adicionar", array("lista"=>$listaCategorias, "categoria"=>$categoria, "erro"=>Reagente::getErro(), "data"=>date('Y-m-d')));	
});

$app->get('/adicionar/:item', function($item){
	Usuario::verificarAcesso();
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$categoria = Itens::buscaCategoriaEditar($item);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("adicionar-".$item, array("categoria"=>$categoria, "voltar"=>$_SESSION[Dados::VOLTAR]));
});

$app->post('/adicionar/:item/:iditem', function($item, $iditem) {
	Usuario::verificarAcesso();
	Itens::atualizarItem($item,$iditem,$_POST);
	header("Location: /adicionar/$item");
	exit;	
});

$app->post('/adicionar/item', function() {
	Usuario::verificarAcesso();
	$_POST['laboratorio'] = $_SESSION[Usuario::USUARIO]['laboratorio'];
	$categoria = new Itens();
	$categoria->setDados($_POST);
	$categoria->salvar(array_keys($_POST)[0]);
	header("Location: /adicionar/".array_keys($_POST)[0]);
	exit;
});

$app->post('/adicionar', function() {
	Usuario::verificarAcesso();
	if (isset($_POST["Importar"])) {		
		try {
			Reagente::ImportarReagentes($_FILES["Lista"],$_SESSION[Usuario::USUARIO]['laboratorio'],$_SESSION[Usuario::USUARIO]["tipo"]);			
		} catch (Exception $e) {
			Reagente::setErro($e->getMessage());
			header("Location: /adicionar");
			exit;			
		}				
	}elseif (isset($_POST["Salvar"])) {

		if ($_POST["registro"]=="") {
			$_POST["registro"]="0000-00-00";
		}
		$reagente = new Reagente();
		$reagente->setDados($_POST);
		
		$reagente->salvar();		
	}elseif (isset($_POST["Excluir"])) {
		Reagente::deletarTudo($_SESSION[Usuario::USUARIO]['laboratorio'],$_SESSION[Usuario::USUARIO]['tipo']);
	}	
	header("Location: /adicionar");
	exit;	
});

$app->get('/adicionar/:item/:iditem/delete', function($item, $iditem) {
	Usuario::verificarAcesso();
	Itens::deletarItem($item,$iditem);
	header("Location: /adicionar/$item");
	exit;	
});
// FINAL DO GERENCIAMENTO DA SESSÃO "INCLUIR REAGENTES"


// INÍCIO DO GERENCIAMENTO DA SESSÃO "CONSULTA"
$app->get('/consulta/:idreagent/delete', function($idreagent) {
	Usuario::verificarAcesso();
	Reagente::deletarReagente($idreagent);
	$reagentes = Reagente::busca($_SESSION[Reagente::BUSCA]);
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$listaControle = Itens::buscaCategoriaGeral("controle");
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagentes"=>$reagentes, "busca"=>$_SESSION[Reagente::BUSCA],"controle"=>$listaControle,"data"=>date('Y-m-d')));
});

$app->get('/consulta', function() {
	Usuario::verificarAcesso();
	if (isset($_SESSION[Reagente::BUSCADO])) {
		unset($_SESSION[Reagente::BUSCADO]);
	}
	$_SESSION[Reagente::BUSCA] = array('reagente'=>"",'responsavel'=>"",'laboratorio'=>$_SESSION[Usuario::USUARIO]["laboratorio"],'validade'=>"",'controle'=>"",'cformula'=>"0",'ccas'=>"0",'ccontrole'=>"0",'cregistro'=>"0",'clocalizacao'=>"1",'cresponsavel'=>"1",'cobservacoes'=>"0");
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$listaControle = Itens::buscaCategoriaGeral("controle");
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("busca"=>$_SESSION[Reagente::BUSCA],"controle"=>$listaControle,"data"=>date('Y-m-d')));
});

$app->get('/consulta/voltar', function() {
	Usuario::verificarAcesso();
	$reagentes = $_SESSION[Reagente::BUSCADO];
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$listaControle = Itens::buscaCategoriaGeral("controle");
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagentes"=>$reagentes,"busca"=>$_SESSION[Reagente::BUSCA],"controle"=>$listaControle,"data"=>date('Y-m-d')));
	exit;
});

$app->post('/consulta', function() {	
	Usuario::verificarAcesso();
	if (isset($_POST["Exportar"]) && isset($_SESSION[Reagente::BUSCADO])) {
		Reagente::arquivoDownload($_SESSION[Reagente::BUSCADO],$_SESSION[Usuario::USUARIO]["sobrenome"]);
	} elseif (isset($_POST["Buscar"])) {
		$_SESSION[Reagente::BUSCA] = $_POST;
		$_SESSION[Reagente::BUSCADO] = Reagente::busca($_SESSION[Reagente::BUSCA]);		
		$selecao = array('cformula'=>"0",'ccas'=>"0",'ccontrole'=>"0",'cregistro'=>"0",'clocalizacao'=>"0",'cresponsavel'=>"0",'cobservacoes'=>"0");
		foreach ($selecao as $key => $value) {
			if (!isset($_SESSION[Reagente::BUSCA][$key])) {
				$_SESSION[Reagente::BUSCA][$key]=$value;
			}
		}
	} elseif (isset($_POST["Excluir"])){
		unset($_POST["Excluir"]);
		foreach($_POST as $indice => $valor){
			Reagente::deletarReagente($indice);
			$_SESSION[Reagente::BUSCADO] = Reagente::busca($_SESSION[Reagente::BUSCA]);
		}
	} else {
		header("Location: /consulta");
		exit;
	}
	$reagentes = $_SESSION[Reagente::BUSCADO];
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$listaControle = Itens::buscaCategoriaGeral("controle");
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagentes"=>$reagentes,"busca"=>$_SESSION[Reagente::BUSCA],"controle"=>$listaControle,"data"=>date('Y-m-d')));
	exit;
});

$app->get('/consulta/:idreagent', function($idreagente) {
	Usuario::verificarAcesso();
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$listaCategorias = Itens::ListaCategoriasReagente();	
	$_SESSION[Dados::VOLTAR] = array("atualizar",$idreagente);
	$reag = new Reagente();
	$reag->setReagenteId((int)$idreagente);
	$reagente = $reag->getDados();
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("editar-idreagente", array("reagente"=>$reagente, "lista"=>$listaCategorias));
});

$app->post('/consulta/:idreagent', function($idreagent) {
	Usuario::verificarAcesso();
	$reagente = new Reagente();
	$reagente->setDados($_POST);
	$reagente->atualizar($idreagent);
	$reagentes = Reagente::busca($_SESSION[Reagente::BUSCA]);
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$listaControle = Itens::buscaCategoriaGeral("controle");
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagentes"=>$reagentes,"busca"=>$_SESSION[Reagente::BUSCA],"controle"=>$listaControle,"data"=>date('Y-m-d')));
});
// FINAL DO GERENCIAMENTO DA SESSÃO "CONSULTA"


// INÍCIO DO GERENCIAMENTO DA SESSÃO "DOCUMENTOS"
$app->get('/documentos/:documento', function($documento) {
	Usuario::verificarAcesso();
	$endereco = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."download".DIRECTORY_SEPARATOR;
	switch ($documento) {
		case '1':
			$endereco = $endereco."Etiquetas.docx";
			break;
		case '2':
			$endereco = $endereco."NBR10004.pdf";
			break;
		case '3':
			$endereco = $endereco."NBR12235.pdf";
			break;
		case '4':
			$endereco = $endereco."Controlados.pdf";
			break;
		case '5':
			$endereco = $endereco."Tutorial.pdf";
			break;
	}
	header("Content-Length: ".filesize($endereco)); // Informa ao navegador o tamanho do arquivo
	header("Content-Disposition: attachment; filename=".basename($endereco)); // Informa ao navegador que a forma de leitura é via anexo para abrir na janela de download e informa o nome do arquivo.
	readfile($endereco); // lê o arquivo	
});

$app->get('/documentos', function() {
	Usuario::verificarAcesso();
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("documentos");	
});
// FINAL DO GERENCIAMENTO DA SESSÃO "DOCUMENTOS"


// INÍCIO DO GERENCIAMENTO DA SESSÃO "BACKUP"
$app->get('/backup', function() {
	Usuario::verificarAcesso();
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("backup", array("erro"=>Reagente::getErro()));	
});

$app->post('/backup', function() {
	Usuario::verificarAcesso();
	if (isset($_POST["ReagentesDownload"])) {
		Reagente::arquivoBackup($_SESSION[Usuario::USUARIO]['laboratorio'],$_SESSION[Usuario::USUARIO]["tipo"]);
		exit;
	} elseif (isset($_POST["BibliotecaDownload"])) {
		Itens::arquivoBackup();
		exit;
	} elseif(isset($_POST["BibliotecaUpload"])) {
		try {
			Itens::ImportarBiblioteca($_FILES["BibliotecaUpload"],$_SESSION[Usuario::USUARIO]['laboratorio'],$_SESSION[Usuario::USUARIO]["tipo"]);			
		} catch (Exception $e) {
			Itens::setErro($e->getMessage());
			header("Location: /backup");
			exit;			
		}
		
	} elseif(isset($_POST["ReagentesUpload"])){
		try {
			Reagente::ImportarReagentes($_FILES["ReagentesUpload"],$_SESSION[Usuario::USUARIO]['laboratorio'],$_SESSION[Usuario::USUARIO]["tipo"]);			
		} catch (Exception $e) {
			Reagente::setErro($e->getMessage());
			header("Location: /backup");
			exit;			
		}		
	}
	$numeroSolicitacoes = Usuario::numeroSolicitacoes()[0];
	$info = array_merge($_SESSION[Usuario::USUARIO],$numeroSolicitacoes);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("backup", array("erro"=>Reagente::getErro()));	
});
// FINAL DO GERENCIAMENTO DA SESSÃO "BACKUP"

$app->get('/sair', function() {
	Usuario::sair();
	header("Location: /");
	exit;	
});

$app->run();

 ?>