<?php 

namespace Invent\DB;
use \Invent\Config;

class Sql {

	private $conn;

	public function __construct()
	{
		$configs = Config::getBancoDeDados(); 
		$this->conn = new \PDO(
			"mysql:dbname=".$configs['dbname'].";host=".$configs['hostname'], 
			$configs['username'],
			$configs['password']
		);
	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value){
		$statement->bindParam($key, $value);
	}

	public function getMySQL($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}
	public function setMySQL($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();
	}

}

 ?>