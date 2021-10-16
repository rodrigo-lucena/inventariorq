<?php

namespace Invent;

class Dados{
	const VOLTAR = "Voltar";
	const ERRO = "ErroUsuario";
	
	private $values = [];

	public function __call($name, $args){
		$method = substr($name, 0, 3);
		$fieldname = substr($name, 3, strlen($name));

		switch ($method) {
			case 'get':
				return $this->values[$fieldname];
				break;
			case 'set':
				$this->values[$fieldname] = $args[0];
				break;		
		}

	}
	public function setDados($data = array()){
		foreach ($data as $key => $value) {
			$this->{"set".$key}($value);
		}
	}
	public function getDados(){
		return $this->values;
	}

	public static function getErro(){
		$msgm = (isset($_SESSION[Dados::ERRO]) && $_SESSION[Dados::ERRO]) ? $_SESSION[Dados::ERRO] : '';
		Dados::limparErro();
		return $msgm;
	}

	public static function limparErro(){
		$_SESSION[Dados::ERRO] = NULL;
	}

	public static function setErro($msgm){
		$_SESSION[Dados::ERRO] = $msgm;
	}

}

?>