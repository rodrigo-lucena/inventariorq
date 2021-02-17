<?php

namespace Invent\Model;
use \Invent\DB\Sql; 


class Reagents extends User{
	
	public static function search($reagente,$responsavel,$base,$controle,$validade){
		$sql = new Sql();
		
		$command = "SELECT r.idreagente, r.nome, r.formula, m.marca, r.volume_massa, r.quantidade, r.validade, l.laboratorio, r.localizacao, rp.responsavel FROM reagentes AS r JOIN marcas_r AS m JOIN controle_r AS c JOIN laboratorios_r AS l JOIN responsaveis_r AS rp ON r.idmarca = m.idmarca AND r.idcontrole = c.idcontrole AND r.idlaboratorios = l.idlaboratorios 	AND r.idresponsavel = rp.idresponsavel WHERE r.nome LIKE :REAGENTE AND rp.responsavel LIKE :RESPONSAVEL AND l.laboratorio LIKE :BASE AND c.idcontrole ".$controle.$validade;

		return $sql->select($command, array(":REAGENTE"=>"%".$reagente."%", ":RESPONSAVEL"=>"%".$responsavel."%", ":BASE"=>"%".$base."%")
			);
		
	}
	public static function lists(){
		$sql = new Sql();
		$list=array("marca"=>"marcas_r", "controle"=>"controle_r", "laboratorio"=>"laboratorios_r", "responsavel"=>"responsaveis_r");

		$lists=array();

		foreach ($list as $key => $value) {
			$command = "SELECT ".$key." FROM ".$value;
			array_push($lists, $sql->select($command));
		}
		return $lists;

	}
	public function save(){
		$sql = new Sql();
		$sql->select("CALL reagent_save()")

	}
}
?>