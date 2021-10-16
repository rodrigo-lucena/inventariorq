<?php

namespace Invent\Relacoes;
use \Invent\DB\Sql; 
use \Invent\Dados;


class Reagente extends Dados{ 
	const BUSCA = "Busca";
	const BUSCADO = "Buscado";

	public static function deletarReagente($iditem){
		$sql = new Sql();
		$sql->setMySQL("DELETE FROM reagente WHERE idreagente = :IDITEM", array(":IDITEM"=>$iditem));
	}
	
	public function setReagenteId($idReagente){
		$reagenteBuscado = Reagente::buscarReagenteId($idReagente);
		$this->setDados($reagenteBuscado[0]);
	}

	public static function buscarReagenteId($idReagente){
		$sql = new Sql();
		$reagenteBuscado = "SELECT r.idreagente, n.nome, g.grau, m.marca, r.volume_massa, u.unidade, r.quantidade, r.registro, r.validade, l.laboratorio, lo.localizacao, rp.responsavel, r.observacoes FROM reagente r JOIN nome n USING(idnome) JOIN grau g USING(idgrau) JOIN controle c USING(idcontrole) JOIN marca m USING(idmarca) JOIN unidade u USING(idunidade) JOIN laboratorio l USING(idlaboratorio) JOIN localizacao lo USING(idlocalizacao) JOIN responsavel rp USING(idresponsavel) WHERE r.idreagente = :IDREAGENTE";
		return $sql->getMySQL($reagenteBuscado, array(":IDREAGENTE"=>$idReagente));				
	}

	public static function busca($tipo){
		$sql = new Sql();
		$command = "SELECT * FROM reagente r JOIN nome n USING(idnome) JOIN grau g USING(idgrau) JOIN controle c USING(idcontrole) JOIN marca m USING(idmarca) JOIN unidade u USING(idunidade) JOIN laboratorio l USING(idlaboratorio) JOIN localizacao lo USING(idlocalizacao) JOIN responsavel rp USING(idresponsavel) 
			WHERE n.nome LIKE :NOME AND rp.responsavel LIKE :RESPONSAVEL AND l.laboratorio LIKE :BASE AND c.controle LIKE :CONTROLE".$tipo["validade"]." ORDER by n.nome";
		return $sql->getMySQL($command, array(":NOME"=>"%".$tipo["reagente"]."%", ":RESPONSAVEL"=>"%".$tipo["responsavel"]."%", ":BASE"=>"%".$tipo["laboratorio"]."%", ":CONTROLE"=>"%".$tipo["controle"]."%")
			);		
	}

	public function salvar(){
		$sql = new Sql();			
		$sql->setMySQL("INSERT INTO reagente (idnome, idgrau, idmarca, volume_massa, idunidade, quantidade, registro, validade, idlaboratorio, idlocalizacao, idresponsavel,observacoes) 
			VALUES((SELECT idnome FROM nome WHERE nome = :NOME),(SELECT idgrau FROM grau WHERE grau = :GRAU), (SELECT idmarca FROM marca WHERE marca = :MARCA), :VOLUME_MASSA, (SELECT idunidade FROM unidade WHERE unidade = :UNIDADE),:QUANTIDADE,:REGISTRO,:VALIDADE,(SELECT idlaboratorio FROM laboratorio WHERE laboratorio = :LABORATORIO), (SELECT idlocalizacao FROM localizacao WHERE localizacao = :LOCALIZACAO), (SELECT idresponsavel FROM responsavel WHERE responsavel = :RESPONSAVEL),:OBSERVACOES)", array(
			":NOME"=>$this->getnome(),
			":GRAU"=>$this->getgrau(),
			":MARCA"=>$this->getmarca(),
			":VOLUME_MASSA"=>$this->getvolume_massa(),
			":UNIDADE"=>$this->getunidade(),
			":QUANTIDADE"=>$this->getquantidade(),
			":REGISTRO"=>$this->getregistro(),
			":VALIDADE"=>$this->getvalidade(),
			":LABORATORIO"=>$this->getlaboratorio(),
			":LOCALIZACAO"=>$this->getlocalizacao(),
			":RESPONSAVEL"=>$this->getresponsavel(),
			":OBSERVACOES"=>$this->getobservacoes()
		));			
	}

	public static function arquivoDownload($lista,$usuario){
		$endereco = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR.$usuario."_exportado.csv";
		$arquivo = fopen($endereco, "w");
		$header = array("nome","formula","controle","marca","volume_massa","unidade","quantidade","registro","validade","localizacao","responsavel","laboratorio","observacoes");
		$headerArquivo = array("Nome",utf8_decode("Fórmula"),"Controle","Marca","Volume_massa","Unidade","Quantidade","Registro","Validade",utf8_decode("Localização"),utf8_decode("Responsável"),utf8_decode("Laboratório"),utf8_decode("Observações"));
		fwrite($arquivo, implode(",", $headerArquivo)."\r\n");		
		foreach ($lista as $linha) {
			$data = array();
			for ($i=0; $i < count($header) ; $i++) {
				if ($header[$i] == "nome") {
				 	array_push($data, utf8_decode($linha[$header[$i]]." ".$linha["grau"]));
				 }else{
				 	array_push($data, utf8_decode($linha[$header[$i]]));
				 }
				
			}
			fwrite($arquivo, implode(",", $data)."\r\n");
		}
		fclose($arquivo);
		header("Content-Type: "."csv"); // Informa ao navegador o tipo do arquivo
		header("Content-Length: ".filesize($endereco)); // Informa ao navegador o tamanho do arquivo
		header("Content-Disposition: attachment; filename=".basename($endereco)); // Informa ao navegador que a forma de leitura é via anexo para abrir na janela de download e informa o nome do arquivo.
		readfile($endereco); // lê o arquivo
		unlink($endereco); // Apaga arquivo		
	}

	public function atualizar($idreagente){
		$sql = new Sql(); 
		$sql->setMySQL("UPDATE reagente SET idnome = (SELECT idnome FROM nome WHERE nome = :NOME),idgrau = (SELECT idgrau FROM grau WHERE grau = :GRAU), idmarca = (SELECT idmarca FROM marca WHERE marca = :MARCA), volume_massa = :VOLUME_MASSA, idunidade = (SELECT idunidade FROM unidade WHERE unidade = :UNIDADE), quantidade = :QUANTIDADE, registro = :REGISTRO, validade = :VALIDADE, idlaboratorio = (SELECT idlaboratorio FROM laboratorio WHERE laboratorio = :LABORATORIO), idlocalizacao = (SELECT idlocalizacao FROM localizacao WHERE localizacao = :LOCALIZACAO), idresponsavel = (SELECT idresponsavel FROM responsavel WHERE responsavel = :RESPONSAVEL), observacoes = :OBSERVACOES WHERE idreagente = :IDREAGENTE", array(
			":IDREAGENTE"=>$idreagente,
			":NOME"=>$this->getnome(),
			":GRAU"=>$this->getgrau(),
			":MARCA"=>$this->getmarca(),
			":VOLUME_MASSA"=>$this->getvolume_massa(),
			":UNIDADE"=>$this->getunidade(),
			":QUANTIDADE"=>$this->getquantidade(),
			":REGISTRO"=>$this->getregistro(),
			":VALIDADE"=>$this->getvalidade(),
			":LABORATORIO"=>$this->getlaboratorio(),
			":LOCALIZACAO"=>$this->getlocalizacao(),
			":RESPONSAVEL"=>$this->getresponsavel(),
			":OBSERVACOES"=>$this->getobservacoes()
		)); 
	}

	public static function deletarTudo($laboratorio,$tipo){
		$sql = new Sql();
		if ($tipo == 0) {
			$sql->setMySQL("DELETE FROM reagente");
		}
		$sql->setMySQL("DELETE FROM reagente WHERE idlaboratorio = (SELECT idlaboratorio FROM laboratorio WHERE laboratorio = :LAB)", array(":LAB"=>$laboratorio));
	}

	public static function ImportarReagentes($arquivo,$laboratorio, $tipo){
		$reagente = new Reagente();
		$extensao = explode(".", $arquivo["name"]);		
		$extensao = end($extensao);
		if ($extensao == "csv") {
			$dist = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR.$laboratorio."_importado.csv";
			move_uploaded_file($arquivo["tmp_name"], $dist);			
			$arquivo = fopen($dist, "r");
			$header = array("nome","grau","marca","volume_massa","unidade","quantidade","registro","validade","localizacao","responsavel","observacoes","laboratorio");
			$n = 1;
			$sql = new Sql();
			$buscaId = "SELECT max(idreagente) AS ultimo FROM reagente";
			$id0 = $sql->getMySQL($buscaId)[0]['ultimo'];						
			while ($row = fgets($arquivo)) {
				$row = trim($row); // limpa espaços vazios do lado esquerdo e direito da string
				$rowArray = explode(",", $row);
				//array_push($rowArray, utf8_decode($laboratorio));
				if (count($rowArray)==count($header)) {
					$linha = array();
					for ($i=0; $i < count($header); $i++) { 
						$linha[$header[$i]]= utf8_encode($rowArray[$i]);
					}
					if ($linha['laboratorio'] != $laboratorio &&  $tipo != 0) {
						throw new \Exception("Nome de laboratório inserido incorretamente na linha $n. Os reagentes referentes às linhas anteriores, caso existam, foram adicionados com sucesso no banco de dados.");
					}


					$reagente->setDados($linha);
					$reagente->salvar();

				}else{
					throw new \Exception("Número de parâmetros incorretos na linha $n. Os reagentes referentes às linhas anteriores, caso existam, foram adicionados com sucesso no banco de dados.");			
				}

				$id1 = $sql->getMySQL($buscaId)[0]['ultimo'];

				if ($id1==$id0) {
					throw new \Exception("Erro na linha $n do arquivo. Os reagentes referentes às linhas anteriores, caso existam, foram adicionados com sucesso no banco de dados.");
					
				}else{
					$id0 = $id1;
				}

				$n++;				
			}
			
		}else{
			throw new \Exception("Extensão de arquivo incompatível");
			
		}
		unlink($dist);
	}

	public static function arquivoBackup($laboratorio,$tipo){	
		$endereco = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR.$laboratorio."_backup_reagentes_".date('d-m-y').".csv";
		$arquivo = fopen($endereco, "w");
		$sql = new Sql();	
		if ($tipo == 0) {			
			$lista = $sql->getMySQL("SELECT * FROM reagente r JOIN nome n USING(idnome) JOIN grau g USING(idgrau) JOIN controle c USING(idcontrole) JOIN marca m USING(idmarca) JOIN unidade u USING(idunidade) JOIN laboratorio l USING(idlaboratorio) JOIN localizacao lo USING(idlocalizacao) JOIN responsavel rp USING(idresponsavel)");
		} else{
			$command = $sql->getMySQL("SELECT * FROM reagente r JOIN nome n USING(idnome) JOIN grau g USING(idgrau) JOIN controle c USING(idcontrole) JOIN marca m USING(idmarca) JOIN unidade u USING(idunidade) JOIN laboratorio l USING(idlaboratorio) JOIN localizacao lo USING(idlocalizacao) JOIN responsavel rp USING(idresponsavel) WHERE l.laboratorio = :LAB",array(":LAB"=>$laboratorio));
		}
		$header = array("nome","grau","marca","volume_massa","unidade","quantidade","registro","validade","localizacao","responsavel","observacoes","laboratorio");

		foreach ($lista as $linha) {
			$dadosLinha = array();
			foreach ($header as $atributo) {
				array_push($dadosLinha, utf8_decode($linha[$atributo]));
			}
			fwrite($arquivo, implode(",", $dadosLinha)."\r\n");
		}			
		fclose($arquivo);
		header("Content-Type: text/csv"); // Informa ao navegador o tipo do arquivo
		header("Content-Length: ".filesize($endereco)); // Informa ao navegador o tamanho do arquivo
		header("Content-Disposition: attachment; filename=".basename($endereco)); // Informa ao navegador que a forma de leitura é via anexo para abrir na janela de download e informa o nome do arquivo.
		readfile($endereco); // lê o arquivo
		unlink($endereco); // Apaga arquivo		
	}

}
?>