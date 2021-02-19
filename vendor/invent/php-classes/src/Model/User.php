<?php

namespace Invent\Model;
use \Invent\DB\Sql; 
use \Invent\Model;


class User extends Model{
	const SESSION = "User";
	
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
		

		if ($password===$data["senha"]) {
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
	public static function verifyLogin($tipo = 0){
		if (!isset($_SESSION[User::SESSION]) || 
			!$_SESSION[User::SESSION] || 
			!(int)$_SESSION[User::SESSION]["idusuario"]>0 ||
			(int)$_SESSION[User::SESSION]["tipo"] !== $tipo) {
			header("Location: /");
			exit;
		}
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
	public static function countSol(){
		$sql = new Sql();
		return $sql->select("SELECT count(*) AS contador FROM usuario WHERE situacao = 0");

	}
}


?>