<?php

namespace Invent\Model;
use \Invent\DB\Sql; 
use \Invent\Model;


class Itens extends Model{
	// Insere novo reagente ou novo candidato a usuário no banco de dados.
	public function save($mode){
		$sql = new Sql();
		switch ($mode) {
			case 'r':
				$sql->select("CALL reagent_save(:nome, :formula, :marca, :volume_massa, :quantidade, :validade, :controle, :compra, :laboratorio, :localizacao, :responsavel)", array(
					":nome"=>$this->getnome(),
					":formula"=>$this->getformula(),
					":marca"=>$this->getmarca(),
					":volume_massa"=>$this->getvolume_massa().$this->getunidade(),
					":quantidade"=>$this->getquantidade(),
					":validade"=>$this->getvalidade(),
					":controle"=>$this->getcontrole(),
					":compra"=>$this->getcompra(),
					":laboratorio"=>$this->getlaboratorio(),
					":localizacao"=>$this->getlocalizacao(),
					":responsavel"=>$this->getresponsavel()
				)); 
				break;
			case 'u':
				$openssl =openssl_encrypt(json_encode($this->getsenha()), 'AES-128-CBC', User::SECRET, 0, User::SECRET_IV); 

				//$resolv = openssl_decrypt($openssl, 'AES-128-CBC', User::SECRET, 0, User::SECRET_IV);

				//var_dump($openssl);
				//exit;
				
				$sql->select("CALL user_save(:nome, :sobrenome, :email, :login, :senha, :laboratorio, :responsavel)",array(
				":nome"=>$this->getnome(),
				":sobrenome"=>$this->getsobrenome(),
				":email"=>$this->getemail(),
				":login"=>$this->getlogin(),
				":senha"=>$openssl,
				":laboratorio"=>$this->getlaboratorio(),
				":responsavel"=>$this->getresponsavel()
				));
				break;
		}	
	}

	// Salva item de seleção (marca, responsavel, laboratorio) pela sessão "Incluir Reagente"
	public static function saveItem($tabela,$atributo,$value){
		$sql = new Sql();
		$sql->select("INSERT INTO ".$tabela." (".$atributo.") VALUES (:VALUE)", array(":VALUE"=>$value));
	} 

	// Lista os itens de seleção (marca, controle, laboratório, responsavel) que aparecem nos formulários para o usuário escolher.
	public static function lists(){ 
		$sql = new Sql();
		$list=array("marca"=>"marca_r", "controle"=>"controle_r", "laboratorio"=>"laboratorio_r", "responsavel"=>"responsavel_r");
		$lists=array();
		foreach ($list as $key => $value) {
			$command = "SELECT ".$key." FROM ".$value;
			array_push($lists, $sql->select($command));
		}
		return $lists;
	}



	// Lista todo conteúdo de uma tabela (marca_r, laboratorio_r e responsavel_r) nos Editares contidos no formulário "Incluir Reagente".
	public static function itens($categoria){
		$sql = new Sql();
		return $sql->select("SELECT * FROM ".$categoria);
		
	}
	// Deleta registro de marca, laboratorio, responsavel, usuario e reagente. 
	public static function deleteItem($categoria, $iditem){
		if ($categoria != "usuario" && $categoria != "reagente") {
			$tabela = $categoria."_r";
		} else{
			$tabela = $categoria;
		}
		$sql = new Sql();
		$sql->select("DELETE FROM ".$tabela." WHERE id".$categoria." = :IDITEM", array(":IDITEM"=>$iditem));

	}
}


?>