<?php

namespace Invent\Model;
use \Invent\DB\Sql; 
use \Invent\Mailer; 



class User extends Itens{
	const SESSION = "User";
	const CONSULTAU = "SELECT * FROM usuario u JOIN laboratorio_r l USING(idlaboratorio) JOIN responsavel_r rp USING(idresponsavel) ";
	const SECRET_IV = "senha           ";
	const SECRET = "12catalogo12    ";
	
	public static function login($login, $password)
	{
		$sql = new Sql();
		$results = $sql->select("SELECT u.idusuario, u.nome, u.sobrenome, u.email, u.login, u.senha, r.responsavel, l.laboratorio, u.tipo, u.situacao FROM usuario AS u JOIN responsavel_r AS r JOIN laboratorio_r AS l
			ON u.idresponsavel = r.idresponsavel and u.idlaboratorio = l.idlaboratorio WHERE login = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results) === 0)
		{
			throw new \Exception("Usuário inexistente ou senha inválida");
			
		}
		$data = $results[0];



		$pass = openssl_decrypt($data['senha'], 'AES-128-CBC', User::SECRET, 0, User::SECRET_IV);
		//Entender porque a instrução acima gera string com aspas duplicadas
		

		if ('"'.$password.'"'===$pass) {
			$user = new User();
			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;
			
		}else{
			throw new \Exception("Usuário inexistente ou senha inválida(2)");
		}
/*
		Usar quando a senha for codificada
		if (password_verify($password, $data["senha"]) === true){
			$user = new User();
			$user->setiduser($data["idusuario"]);


		} else{
			throw new \Exception("Usuário inexistente ou senha inválida");
		}
*/

	}
	public static function verifyLogin(){
		if (!isset($_SESSION[User::SESSION]) || 
			!$_SESSION[User::SESSION] || 
			!(int)$_SESSION[User::SESSION]["idusuario"]>0 ||
			(int)$_SESSION[User::SESSION]["situacao"]==0) {
			header("Location: /");
			exit;
		}
	}

	
	public function searchLoginEmail(){
		$sql = new Sql();
		return $sql->select("SELECT count(*) AS contador FROM usuario WHERE login= :LOGIN OR email= :EMAIL", array(":LOGIN"=>$this->getlogin(),":EMAIL"=>$this->getemail()
	));
	}

	public static function logout(){
		$_SESSION[User::SESSION] = NULL;

	}
	public static function listAll($sit=1){
		$sql = new Sql();
		return $sql->select("SELECT u.idusuario, u.nome, u.sobrenome, u.email, u.login, r.responsavel, u.tipo FROM usuario AS u LEFT OUTER JOIN responsavel_r AS r
			ON u.idresponsavel = r.idresponsavel
			WHERE u.situacao = :SIT
			ORDER BY u.nome",array(":SIT"=>$sit));

	}

	public function get($iduser){
		$sql = new Sql();
		$command=User::CONSULTAU."WHERE idusuario = :ID";
		$result = $sql->select($command, array(":ID"=>$iduser));
		$this->setData($result[0]);
	}


	public static function countSol(){
		$sql = new Sql();
		return $sql->select("SELECT count(*) AS contador FROM usuario WHERE situacao = 0");

	}

	public function update($iduser){
		$sql = new Sql();
		$sql->select("CALL user_update(:idusuario, :nome, :sobrenome, :email, :login, :senha, :laboratorio, :responsavel, :tipo, :situacao)", array(
					":idusuario"=>$iduser,
					":nome"=>$this->getnome(),
					":sobrenome"=>$this->getsobrenome(),
					":email"=>$this->getemail(),
					":login"=>$this->getlogin(),
					":senha"=>$this->getsenha(),
					":laboratorio"=>$this->getlaboratorio(),
					":responsavel"=>$this->getresponsavel(),
					":tipo"=>$this->gettipo(),
					":situacao"=>$this->getsituacao()

				)); 
	}
	public static function getForgot($email){
		$sql = new Sql();
		$command=User::CONSULTAU."WHERE email = :EMAIL";
		$resultUser = $sql->select($command, array(":EMAIL"=>$email));

		if (count($resultUser)===0) {
			throw new \Exception("Não foi possível recuperar a senha");
			
		} else{
			$data = $resultUser[0];
			$resultRecup = $sql->select("CALL recup_senha(:idusuario, :ip)", array(":idusuario"=>$data["idusuario"], ":ip"=>$_SERVER["REMOTE_ADDR"]));
			//var_dump($resultRecup);
			//exit;
		}
		if (count($resultRecup)===0) {
			throw new \Exception("Não foi possível recuperar a senha");
		}else { // Recuperando os dados da tabela recup_senha, encriptografando seu idrecup_senha e enviando para o email do usuário:
			$dataRecovery = $resultRecup[0];
			$code =openssl_encrypt(json_encode($dataRecovery["idrecup_senha"]), 'AES-128-CBC', User::SECRET, 0, User::SECRET_IV);
			$link = "http://www.inventariorq.com.br/esqueceu/reset?code=$code";
			$mailer = new Mailer($data["email"],$data["nome"], "Redefinir senha do InventárioRQ","esqueceu_email", array(
				"nome"=>$data["nome"],
				"link"=>$link
			));

			$mailer->send();
			return $data;


		}





	}
}


?>