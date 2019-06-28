<?php 
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\Skill;

class SkillModel extends Model
{
	private function buildObject($row)
	{
		$skill = new Skill();
		$skill->setID($row["ID"]);
		$skill->setTitle($row["title"]);
		$skill->setPictureName($row["pictureName"]);
		$skill->setProgress($row["progress"]);
		return $skill;
	}

	public function getSkills()
	{
		$sql = 
			"SELECT ID, title, pictureName, progress
			FROM skills";
		$result = $this->dataBase->createRequest($sql);
		$skills = [];
		forEach($result as $row)
		{
			$skillID = $row["ID"];
			$skills[$skillID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $skills;
	}

	public function editSkillsProgress($skillName, $skillProgress)
	{
		$sql = 
			"UPDATE skills
			SET progress = '$skillProgress'
			WHERE title = '$skillName'";
		$editContent = $this->dataBase->createRequest($sql);
	}
}