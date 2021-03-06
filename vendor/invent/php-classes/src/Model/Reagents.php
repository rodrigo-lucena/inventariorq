<?php

namespace Invent\Model;
use \Invent\DB\Sql; 




class Reagents extends Itens{ 
	const CONSULTA = "SELECT * FROM reagente r JOIN marca_r m USING(idmarca) JOIN controle_r c USING(idcontrole) JOIN laboratorio_r l USING(idlaboratorio) JOIN responsavel_r rp USING(idresponsavel) ";
	



	//Busca realizada na seção "Consulta"
//	public static function search($reagente,$responsavel,$base,$controle,$validade){
	public static function search($tipo){
		$sql = new Sql();
		$command = Reagents::CONSULTA."WHERE r.nome LIKE :REAGENTE AND rp.responsavel LIKE :RESPONSAVEL AND l.laboratorio LIKE :BASE AND c.idcontrole ".$tipo[3].$tipo[4]." ORDER by r.nome";

		return $sql->select($command, array(":REAGENTE"=>"%".$tipo[0]."%", ":RESPONSAVEL"=>"%".$tipo[1]."%", ":BASE"=>"%".$tipo[2]."%")
			);
		
		
	}
	
	public function get($idreagent){
		$sql = new Sql();
		$command=Reagents::CONSULTA."WHERE idreagente = :ID";
		$result = $sql->select($command, array(":ID"=>$idreagent));
		$this->setData($result[0]);
	}

	public function update($idreagent){
		$sql = new Sql();
		$sql->select("CALL reagent_update(:idreagente, :nome, :formula, :marca, :volume_massa, :quantidade, :validade, :controle, :compra, :laboratorio, :localizacao, :responsavel)", array(
					":idreagente"=>$idreagent,
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
	}

}
?>