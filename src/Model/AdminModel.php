<?php
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\Admin;

class AdminModel extends Model
{
	private function buildObject($row)
	{
		$admin = new Admin;
		$admin->setID($row["ID"]);
		$admin->setName($row["name"]);
		$admin->setPassword($row["password"]);
		$admin->setRights($row["rights"]);
		return $admin;
	}

	public function getAdminsList()
	{
		$sql =
			"SELECT ID, name, password, rights
			FROM admin";
		$result = $this->dataBase->createRequest($sql);
		$adminsList = [];
		forEach($result as $row)
		{
			$adminID = $row["ID"];
			$adminsList[$adminID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $adminsList;
	}

	public function addAdmin($name, $password, $rights)
	{
		$sql =
			"INSERT INTO admin (name, password, rights)
			VALUES (?, ?, ?)";
		$addAdmin = $this->dataBase->createRequest($sql, [$name, $password, $rights]);
	}

	public function deleteAdmin($adminID)
	{
		$sql = 
			"DELETE FROM admin
			WHERE ID = ?";
		$deleteAdmin = $this->dataBase->createRequest($sql, [$adminID]);
	}

	public function checkAdminIfExist($nameAdmin)
	{
		$sql =
			"SELECT ID, name, password, rights 
			FROM admin
			WHERE name = ?";
		$result = $this->dataBase->createRequest($sql, [$nameAdmin]);
		$admin = $result->fetch();
		$result->closeCursor();
		if ($admin)
		{
			return $this->buildObject($admin);
		}
		else
		{
			return;
		}
	}
}
