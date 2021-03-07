<?php 

session_start();
require_once "vendor/autoload.php";

use \Slim\Slim; 
use \Invent\Page;
use \Invent\Model\User;
use \Invent\Model\Reagents;

$app = new Slim();
$app->config('debug', true); // Modo debug para visualizar erros. Pode retirá-lo no final.

$app->get('/', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("login");
});

$app->post('/', function() {

	User::login($_POST["login"],$_POST["password"]);

	header("Location: /consulta");
	exit;
});


$app->get('/cadastro', function() {	
	$lists = Reagents::lists();	
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("cadastro", array("lists"=>$lists));
});

$app->post('/cadastro', function() {
	// Ainda falta verificar se as duas senhas são iguais - ok
	// Ainda falta colocar um sistema anti robô
	// Ainda falta criptografar a senha antes de enviá-la para o banco de dados - ok
	$usuario = new User();
	$usuario->setData($_POST);
	$validar = $usuario->searchLoginEmail();
	if ($validar[0]["contador"]=="0") $usuario->save("u");
	header("Location: /");	
	exit;
	// Inserir mensagem informando que os dados foram enviados com sucesso ou que já existe usuário com mesmo login ou email.
	
});

$app->get('/esqueceu', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("esqueceu");
});

$app->post('/esqueceu', function() {
	
	$user = User::getForgot($_POST["email"]);
	header("Location: /esqueceu/enviado");
	exit;
});

$app->get('/esqueceu/enviado', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("esqueceu_enviado"); // montar página esqueceu_enviado.html
	
});

$app->get('/esqueceu/email', function() {
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("esqueceu_email"); // montar página esqueceu_enviado.html
	
});

// INÍCIO DO GERENCIAMENTO DA SESSÃO "CONSULTA"

$app->get('/consulta/:idreagent/delete', function($idreagent) {
	User::verifyLogin();
	Reagents::deleteItem("reagente",$idreagent);

	$reagents = Reagents::search($_SESSION["BUSCA"]);
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagents"=>$reagents, "busca"=>$_SESSION["BUSCA"]));
});

$app->get('/consulta/:idreagent', function($idreagent) {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$lists = Reagents::lists();
	$reag = new Reagents();
	$reag->get((int)$idreagent);
	$reagent = $reag->getValues();
	$volume_massa = explode(" ", $reag->getvolume_massa());
	$reagent = array_merge($reagent,array("volume_massa"=>$volume_massa[0],"unidade"=>$volume_massa[1]));
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("editar-idreagente", array("reagent"=>$reagent, "lists"=>$lists));
});


$app->post('/consulta/:idreagent', function($idreagent) {
	User::verifyLogin();
	$reagent = new Reagents();
	$reagent->setData($_POST);
	$reagent->update($idreagent);

	$reagents = Reagents::search($_SESSION["BUSCA"]);
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagents"=>$reagents, "busca"=>$_SESSION["BUSCA"]));
});


$app->post('/consulta', function() {
	User::verifyLogin();
	$_SESSION["BUSCA"] = array($_POST["Reagente"],$_POST["Responsavel"], $_POST["radioB"], $_POST["radioC"], $_POST["radioV"]);
	$reagents = Reagents::search($_SESSION["BUSCA"]);
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagents"=>$reagents,"busca"=>$_SESSION["BUSCA"]));
});

$app->get('/consulta', function() {
	User::verifyLogin();
	$_SESSION["BUSCA"] = array("olá","", "c", ">= 1", "");
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("busca"=>$_SESSION["BUSCA"]));
});
// FINAL DO GERENCIAMENTO DA SESSÃO "CONSULTA"

// INÍCIO DO GERENCIAMENTO DA SESSÃO "INCLUIR REAGENTES"
$app->post('/adicionar/item', function() {
	User::verifyLogin();
	switch (array_keys($_POST)[0]) {
		case 'marca':
			Reagents::saveItem("marca_r","marca",$_POST["marca"]);
			break;
		case 'laboratorio':
			Reagents::saveItem("laboratorio_r","laboratorio",$_POST["laboratorio"]);
			break;
		case 'responsavel':
			Reagents::saveItem("responsavel_r","responsavel",$_POST["responsavel"]);
			break;
	}		
	header("Location: /adicionar/".array_keys($_POST)[0]);
	exit;
});

$app->get('/adicionar/:item/:iditem/delete', function($item, $iditem) {
	User::verifyLogin();
	Reagents::deleteItem($item,$iditem);
	header("Location: /adicionar/$item");
	exit;	
});

$app->get('/adicionar/:item', function($item){
	User::verifyLogin();	
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);

	$categoria = Reagents::itens($item."_r");
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("adicionar-".$item, array("categoria"=>$categoria));
});

$app->get('/adicionar', function() {
	User::verifyLogin();	
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$lists = Reagents::lists();
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("adicionar", array("lists"=>$lists));	
});

$app->post('/adicionar', function() {
	User::verifyLogin();
	$reagent = new Reagents();
	$reagent->setData($_POST);
	$reagent->save("r");	
	header("Location: /adicionar");
	exit;	
});
// FINAL DO GERENCIAMENTO DA SESSÃO "INCLUIR REAGENTES"


$app->get('/usuarios/:idusuario/delete', function($idusuario) {
	User::verifyLogin();
	User::deleteItem("usuario",$idusuario);
	header("Location: /usuarios");
	exit;	
});

$app->get('/usuarios/:idusuario', function($idusuario) {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$lists = Reagents::lists();
	$users = new User();
	$users->get((int)$idusuario);
	$user = $users->getValues();
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("usuario-update", array("user"=>$user, "lists"=>$lists));
});

$app->post('/usuarios/:idusuario', function($idusuario) {
	User::verifyLogin();
	$user = new User();
	$user->get((int)$idusuario);
	if (!isset($_POST["tipo"])) {
		$_POST["tipo"]=2;
	}
	$user->setData($_POST);
	$user->update($idusuario);
	var_dump($user->getValues());
	header("Location: /usuarios");
	exit;

});

$app->get('/usuarios', function() {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$users = User::listAll();
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("usuarios", array("users"=>$users));	
});

$app->get('/solicita', function() {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$users = User::listAll(0);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("solicita", array("users"=>$users));	
});

$app->get('/documentos', function() {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("documentos");	
});

$app->get('/logout', function() {

	User::logout();
	header("Location: /");
	exit;	
});

$app->run();
 
 ?>