<?php
namespace Invent\Relacoes;
use \Invent\DB\Sql; 
use \Invent\Dados;

class Itens extends Dados{
	const ERROR = "ItemError";
	

	public static function ListaCategoriasUsuario(){ //Usada por enquanto no cadastro 
		$sql = new Sql();
		$atributos=array("laboratorio", "responsavel"); // ir adicionando mais itens conforme necessitar
		$lista=array();
		foreach ($atributos as $valor) {
			array_push($lista, Itens::buscaCategoriaGeral($valor));
			}
		return $lista;
	}

	public static function ListaCategoriasReagente(){ 
		$sql = new Sql();
		$atributos=array("nome","marca", "laboratorio", "responsavel", "localizacao", "unidade","grau");
		$lista=array();
		foreach ($atributos as $valor) {
			array_push($lista, Itens::buscaCategoriaGeral($valor));	
		}
		return $lista;
	}

	public static function buscaCategoriaGeral($nomeAtributoTabela){
		$sql = new Sql();
		return $sql->getMySQL("SELECT ".$nomeAtributoTabela." FROM ".$nomeAtributoTabela);
	} 

	public static function buscaCategoriaEditar($nomeAtributoTabela){
		$sql = new Sql();
		if ($nomeAtributoTabela == "localizacao") {
			return $sql->getMySQL("SELECT * FROM localizacao JOIN laboratorio USING(idlaboratorio) GROUP BY localizacao");
		} elseif($nomeAtributoTabela == "nome"){
			$lista = array($sql->getMySQL("SELECT * FROM nome n JOIN controle c USING(idcontrole) GROUP BY nome"));
			array_push($lista, Itens::buscaCategoriaGeral("controle"));
			return $lista;
		}else{
			return $sql->getMySQL("SELECT * FROM ".$nomeAtributoTabela." GROUP BY ".$nomeAtributoTabela);
		}
		
	} 

	public function salvar($tabela){
		$sql = new Sql();
		switch ($tabela) {
			case 'nome':
				$sql->setMySQL("INSERT INTO nome (nome, formula, cas, idcontrole) 
				VALUES(:NOME, :FORMULA, :CAS, (SELECT idcontrole FROM controle WHERE controle = :CONTROLE))", array(
				":NOME"=>$this->getnome(),
				":FORMULA"=>$this->getformula(),
				":CAS"=>$this->getcas(),
				":CONTROLE"=>$this->getcontrole(),
				));
				break;
			case 'localizacao':
				$sql->setMySQL("INSERT INTO localizacao (localizacao, idlaboratorio) VALUES(:LOCALIZACAO, (SELECT idlaboratorio FROM laboratorio WHERE laboratorio = :LABORATORIO))",array(
				":LOCALIZACAO"=>$this->getlocalizacao(),
				":LABORATORIO"=>$_SESSION[Usuario::USUARIO]['laboratorio']
				));
				break;			
			default:
				$sql->setMySQL("INSERT INTO ".$tabela." (".$tabela.") VALUES(:VALOR)",array(
					":VALOR"=>$this->{"get".$tabela}()
				));
				break;
		}
	}		

	public static function deletarItem($tabela, $iditem){
		$sql = new Sql();
		$sql->setMySQL("DELETE FROM ".$tabela." WHERE id".$tabela." = :IDITEM", array(":IDITEM"=>$iditem));
	}
 
	public static function atualizarItem($tabelaAtributo, $iditem, $novoValor= array()){
		$sql = new Sql();
		if ($tabelaAtributo == "nome") {
			$sql->setMySQL("UPDATE nome SET nome = :NOME, formula = :FORMULA, cas = :CAS, idcontrole = (SELECT idcontrole FROM controle WHERE controle = :CONTROLE) WHERE idnome = :IDITEM", array(
				":NOME"=>$novoValor["nome"],
				":FORMULA"=>$novoValor["formula"],
				":CAS"=>$novoValor["cas"],
				":CONTROLE"=>$novoValor["controle"],
				":IDITEM"=>$iditem

			));
		} else{
			$sql->setMySQL("UPDATE ".$tabelaAtributo." SET ".$tabelaAtributo." = '".$novoValor[$tabelaAtributo]. "' WHERE id".$tabelaAtributo." = :IDITEM", array(":IDITEM"=>$iditem));
		}		
	}

	public static function arquivoBackup(){			
		$endereco = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR."backup_biblioteca_".date('d-m-y').".csv";
		$arquivo = fopen($endereco, "w");
		//$sql = new Sql();				
		$categorias = array("controle","marca","grau","unidade","localizacao","responsavel","laboratorio","nome");

		foreach ($categorias as $categoria) {
			fwrite($arquivo, $categoria."\r\n");
			$lista = Itens::buscaCategoriaEditar($categoria);
			if ($categoria == "nome") $lista = $lista[0];
			foreach ($lista as $linha) {
				$dadosLinha = array();
				if ($categoria == "nome") {					
					$cabecalho = array("nome", "formula", "cas", "controle");
				}elseif ($categoria == "localizacao") {
					$cabecalho = array("localizacao", "laboratorio");
				} else{

					$cabecalho = array($categoria);
				}				
				foreach($cabecalho as $atributo){
					array_push($dadosLinha, utf8_decode($linha[$atributo]));		
				}
				fwrite($arquivo, implode(",", $dadosLinha)."\r\n");
			}			
		}					
		fclose($arquivo);
		header("Content-Type: "."csv"); // Informa ao navegador o tipo do arquivo
		header("Content-Length: ".filesize($endereco)); // Informa ao navegador o tamanho do arquivo
		header("Content-Disposition: attachment; filename=".basename($endereco)); // Informa ao navegador que a forma de leitura é via anexo para abrir na janela de download e informa o nome do arquivo.
		readfile($endereco); // lê o arquivo
		unlink($endereco); // Apaga arquivo	
		
	}

	public static function ImportarBiblioteca($arquivo,$laboratorio, $tipo){
		$item = new Itens();
		$extensao = explode(".", $arquivo["name"]);		
		$extensao = end($extensao);
		if ($extensao == "csv") {
			$dist = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."temp".DIRECTORY_SEPARATOR.$laboratorio."_importado.csv";
			move_uploaded_file($arquivo["tmp_name"], $dist);			
			$arquivo = fopen($dist, "r");			
			$categorias = array("controle","marca","grau","unidade","localizacao","responsavel","laboratorio","nome","fim");
			$j=-1;
			$n = 1;
			$sql = new Sql();
			while ($row = fgets($arquivo)) {
				$row = trim($row); // limpa espaços vazios do lado esquerdo e direito da string
				$rowArray = explode(",", $row);

				if ($rowArray[0] == $categorias[$j+1]) {
					$j++;
					$n++;
					$sql->setMySQL("ALTER TABLE ".$categorias[$j]." AUTO_INCREMENT = 1");
				}else{
					if ($categorias[$j] == "localizacao") {
						$header = array("localizacao","laboratorio");
					} elseif ($categorias[$j] == "nome") {
						$header = array("nome","formula","cas","controle");	
					} else{
						$header = array($categorias[$j]);
					}

					if (count($rowArray) == count($header)) {
						$linha = array();
						for ($i=0; $i < count($header); $i++) { 
							$linha[$header[$i]]= utf8_encode($rowArray[$i]);
						}
						$item->setDados($linha);
						$item->salvar($categorias[$j]);
					}else{
						throw new \Exception("Número de parâmetros incorretos na linha $n. Os itens referentes às linhas anteriores, caso existam, foram adicionados com sucesso no banco de dados.");
					}
				}			
				$n++;				
			}			
		}else{
			throw new \Exception("Extensão de arquivo incompatível");			
		}
		unlink($dist);
	}		
}

?>