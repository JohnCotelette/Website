<?php 
namespace App\Src\Framework;
use PDO;
use Exception;

class Database
{
	private $connection;

	private function checkConnection()
	{
		if ($this->connection === null)
		{
			return $this->getConnection();
		}
		else 
		{
			return $this->connection;
		}
	}

	private function getConnection()
	{
		try
		{
			$this->connection = new PDO(DB_HOST, DB_USER, DB_PASSWORD);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->connection;
		}

		catch(Exception $errorConnect)
		{
			"Erreur: " . $errorConnect->getMessage();
		}
	}

	public function createRequest($sql, $parameters = null)
	{
		if ($parameters)
		{
			$result = $this->checkConnection()->prepare($sql);
			$result->execute($parameters);
			return $result;
		} 
		else 
		{
			$result= $this->checkConnection()->query($sql);
			return $result;
		}
	}
}