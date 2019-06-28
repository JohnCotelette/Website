<?php 
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\SiteContent;

class SiteContentModel extends Model
{
	private function buildObject($row)
	{
		$siteContent = new siteContent();
		$siteContent->setID($row["ID"]);
		$siteContent->setBigTitleHeader($row["bigTitleHeader"]);
		$siteContent->setSmallTitleHeader($row["smallTitleHeader"]);
		$siteContent->setCVDesc($row["cvDesc"]);
		$siteContent->setCVDescMore($row["cvDescMore"]);
		$siteContent->setEmail($row["email"]);
		$siteContent->setPhoneNumber($row["phoneNumber"]);
		return $siteContent;
	}

	public function getContent()
	{
		$sql = 
			"SELECT ID, bigTitleHeader, smallTitleHeader, cvDesc, cvDescMore, email, phoneNumber
			FROM sitecontent";
		$result = $this->dataBase->createRequest($sql);
		$siteContent = [];
		forEach($result as $row)
		{
			$siteContentID = $row["ID"];
			$siteContent[$siteContentID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $siteContent;
	}

	public function editContent($bigTitleHeader, $smallTitleHeader, $cvDesc, $cvDescMore, $email, $phoneNumber)
	{
		$sql = 
			"UPDATE siteContent
			SET bigTitleHeader = '$bigTitleHeader',
			 	smallTitleHeader = '$smallTitleHeader',
			 	cvDesc = '$cvDesc',
			 	cvDescMore = '$cvDescMore',
			 	email = '$email',
			 	phoneNumber = '$phoneNumber' 
			WHERE ID = 1";
		$editContent = $this->dataBase->createRequest($sql);
	}
}