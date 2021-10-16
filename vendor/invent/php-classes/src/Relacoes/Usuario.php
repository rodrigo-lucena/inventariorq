<?php

namespace Invent\Relacoes;
use \Invent\Config;
use \Invent\DB\Sql; 
use \Invent\Mailer;
use \Invent\Dados; 

class Usuario extends Dados{
	
	const USUARIO = "Usuario";

	public static function aceitarUsuario($idusuario){
		$sql = new Sql();
		$sql->setMySQL("UPDATE usuario SET situacao = 1 WHERE idusuario = :idusuario", array(":idusuario"=>$idusuario));
		$usuarioBuscado = Usuario::buscarUsuarios("idusuario",$idusuario);
//ALTERAR O ENDEREÇO DO DOMÍNIO DO SITE NO ARQUIVO solicita_email.html 
		$mailer = new Mailer($usuarioBuscado[0]["email"], $usuarioBuscado[0]["nome"], "Aceite de cadastro no InventárioRQ","solicita_email", array(
				"nome"=>$usuarioBuscado[0]["nome"]
			));
		$mailer->send();
	}

	public static function acessar($emailInserido, $senhaInserida){
		$sql = new Sql();
		$usuarioBuscado = Usuario::buscarUsuarios("email",$emailInserido);
		if (count($usuarioBuscado) === 0){
			throw new \Exception("Usuário inexistente ou senha inválida");
		}
		if (password_verify($senhaInserida, $usuarioBuscado[0]["senha"]) === true && $usuarioBuscado[0]["situacao"]==1){
			$usuario = new Usuario();
			$usuario->setDados($usuarioBuscado[0]);
			$_SESSION[Usuario::USUARIO] = $usuario->getDados();
			return $usuario;
		} else if (password_verify($senhaInserida, $usuarioBuscado[0]["senha"]) === true && $usuarioBuscado[0]["situacao"]==0){
			throw new \Exception("Cadastro ainda não aprovado");
		} else {
			throw new \Exception("Usuário inexistente ou senha inválida!");
		}
	}

	public function atualizarSenha($senha){
		$senha_hash = password_hash($senha, PASSWORD_DEFAULT); 
		$sql = new Sql();
		$sql->setMySQL("UPDATE usuario SET senha = :senha WHERE idusuario = :idusuario", array(":senha"=>$senha_hash, ":idusuario"=>$this->getidusuario()));
	}

	public function atualizarUsuario($idUsuario){
		$sql = new Sql();
		$sql->setMySQL("UPDATE usuario SET nome = :nome, sobrenome = :sobrenome, email = :email, senha = :senha, idlaboratorio = (SELECT idlaboratorio FROM laboratorio WHERE laboratorio = :laboratorio), idresponsavel = (SELECT idresponsavel FROM responsavel WHERE responsavel = :responsavel), tipo = :tipo, situacao = :situacao WHERE idusuario = :idusuario", array(
					":idusuario"=>$idUsuario,
					":nome"=>$this->getnome(),
					":sobrenome"=>$this->getsobrenome(),
					":email"=>$this->getemail(),
					":senha"=>$this->getsenha(),
					":laboratorio"=>$this->getlaboratorio(),
					":responsavel"=>$this->getresponsavel(),
					":tipo"=>$this->gettipo(),
					":situacao"=>$this->getsituacao()
				)); 
	}	

	public static function buscarEmailAdmin($laboratorio){
		$sql = new Sql();		
		$busca = $sql->getMySQL("SELECT email FROM usuario WHERE idlaboratorio= (SELECT idlaboratorio FROM laboratorio WHERE laboratorio = :LABORATORIO AND tipo = 1)", array(":LABORATORIO"=>$laboratorio
			));
		if (empty($busca)){
			return $sql->getMySQL("SELECT email FROM usuario WHERE tipo = 0");
		} else{
			return $busca;
		}
	}

	public static function buscarUsuarios($atributo,$valor){
		$sql = new Sql();
		$comando = "SELECT u.idusuario, u.nome, u.sobrenome, u.email, u.senha, l.laboratorio, r.responsavel, u.tipo, u.situacao FROM usuario AS u JOIN responsavel AS r JOIN laboratorio AS l ON u.idresponsavel = r.idresponsavel and u.idlaboratorio = l.idlaboratorio WHERE u.".$atributo." = :VALOR ORDER BY u.nome";
		return $sql->getMySQL($comando, array(":VALOR"=>$valor));
	}

	public static function deleteUsuario($idusuario){
		$sql = new Sql();
		$sql->setMySQL("DELETE FROM usuario WHERE idusuario = :ID", array(":ID"=>$idusuario));
	}

	public static function envioEsqueceuSenha($emailInserido){
		$senhaConfigs = Config::getSenha();
		$sql = new Sql();
		$usuarioBuscado = Usuario::buscarUsuarios("email",$emailInserido);
		if (count($usuarioBuscado)===0) {
			throw new \Exception("Email não encontrado");			
		} else{
			//$data = $usuarioBuscado[0];			
			$sql->setMySQL("INSERT INTO recup_senha (idusuario, ip, tentativa_horario) VALUES(:idusuario, :ip, now())", array(":idusuario"=>$usuarioBuscado[0]["idusuario"], ":ip"=>$_SERVER["REMOTE_ADDR"]));
			$resultRecup = $sql->getMySQL("SELECT * FROM recup_senha WHERE idrecup_senha = last_insert_id()");
			$sql->setMySQL("DELETE FROM inventariorq.recup_senha WHERE register < (now()-INTERVAL 180 day)");
		}
		if (count($resultRecup)===0) {
			throw new \Exception("Não foi possível recuperar a senha");
		}else { // Recuperando os dados da tabela recup_senha, encriptografando seu idrecup_senha e enviando para o email do usuário:
			//$dataRecovery = $resultRecup[0];
			$code =urlencode(openssl_encrypt($resultRecup[0]["idrecup_senha"], 'AES-128-CBC', $senhaConfigs['secret'], 0, $senhaConfigs['secret_IV']));
		// ALTERAR AQUI DE ACORDO COM O DOMÍNIO DO SITE:
			$link = "http://www.inventariorq2.com.br/esqueceu/reset?code=$code";
			$mailer = new Mailer($usuarioBuscado[0]["email"],$usuarioBuscado[0]["nome"], "Redefinir senha do InventárioRQ","esqueceu_email", array(
				"nome"=>$usuarioBuscado[0]["nome"],
				"link"=>$link
			));

			$mailer->send();
		}
	}

	public static function numeroSolicitacoes(){
		$sql = new Sql();
		return $sql->getMySQL("SELECT count(*) AS contador FROM usuario WHERE situacao = 0");
	}

	public static function registrarRecupSenha($idrecup_senha){
		$sql = new Sql();
		$sql->setMySQL("UPDATE recup_senha SET efetivada_horario = NOW() WHERE idrecup_senha = :idrecup_senha", array(":idrecup_senha"=>$idrecup_senha));
	}

	public static function sair(){
		$_SESSION[Usuario::USUARIO] = NULL;
	}

	public function salvar(){
		$sql = new Sql();
			$senha_hash = password_hash($this->getsenha(), PASSWORD_DEFAULT);
			$sql->setMySQL("INSERT INTO usuario (nome, sobrenome, email, senha, idlaboratorio, idresponsavel, tipo, situacao) 
				VALUES(:nome, :sobrenome, :email, :senha, (SELECT idlaboratorio FROM laboratorio WHERE laboratorio = :laboratorio), (SELECT idresponsavel FROM responsavel
					WHERE responsavel = :responsavel), 2, 0)",array(
				":nome"=>$this->getnome(),
				":sobrenome"=>$this->getsobrenome(),
				":email"=>$this->getemail(),
				":senha"=>$senha_hash,
				":laboratorio"=>$this->getlaboratorio(),
				":responsavel"=>$this->getresponsavel()
				));
	}

	public function setUsuarioId($idUsuario){
		$sql = new Sql();
		$usuarioBuscado = Usuario::buscarUsuarios("idusuario",$idUsuario);
		$this->setDados($usuarioBuscado[0]);
	}

	public static function validarEsqueceuSenha($code){
		$senhaConfigs = Config::getSenha();	
		$idrecup_senha = openssl_decrypt($code, 'AES-128-CBC', $senhaConfigs['secret'], 0, $senhaConfigs['secret_IV']);
		$sql = new Sql();
		$usuarioRecup = $sql->getMySQL("SELECT * FROM recup_senha r JOIN usuario u USING(idusuario) WHERE 
			r.idrecup_senha = :ID AND date_add(r.tentativa_horario, interval 1 hour)>=now();", array(":ID"=>$idrecup_senha));		
		if (count($usuarioRecup)===0) {
			throw new \Exception("Não foi possível recuperar a senhalllll");		
		} else{
			return $usuarioRecup[0];
		}
	}

	public static function verificarAcesso(){
		if (!isset($_SESSION[Usuario::USUARIO]) || 
			!$_SESSION[Usuario::USUARIO] || 
			!(int)$_SESSION[Usuario::USUARIO]["idusuario"]>0 ||
			(int)$_SESSION[Usuario::USUARIO]["situacao"]==0) {
			header("Location: /");
			exit;
		}
	}

	public function verificarEmail(){
		$sql = new Sql();
		$busca = $sql->getMySQL("SELECT count(*) AS contador FROM usuario WHERE email= :EMAIL", array(":EMAIL"=>$this->getemail()
			));
		if ($busca[0]["contador"] =="0") {
			return $busca;
		}else{
			throw new \Exception("Email já cadastrado");			
		}
	}	
}	
?>