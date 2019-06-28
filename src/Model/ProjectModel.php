<?php 
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\Project;
use PDO;

class ProjectModel extends Model
{
	private function buildObject($row)
	{
		$project = new Project();
		$project->setID($row["ID"]);
		$project->setTitle($row["title"]);
		$project->setType($row["type"]);
		$project->setLink($row["link"]);
		$project->setGithubLink($row["githubLink"]);
		$project->setPictureName($row["pictureName"]);
		$project->setDescription($row["description"]);
		return $project;
	}

	public function getProjects()
	{
		$sql = 
			"SELECT ID, title, type, link, githubLink, pictureName, description
			FROM projects";
		$result = $this->dataBase->createRequest($sql);
		$projects = [];
		forEach($result as $row)
		{
			$projectID = $row["ID"];
			$projects[$projectID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $projects;
	}

	public function getOneProject($projectID, $parameter = null)
	{
		$sql =
			"SELECT ID, title, type, link, githubLink, pictureName, description
			FROM projects
			WHERE ID = ?";
		$result = $this->dataBase->createRequest($sql, [$projectID]);
		if (!$parameter)
		{
			$project = $result->fetch();
			$result->closeCursor();
			return $this->buildObject($project);
		}
		else
		{
			$project = $result->fetch(PDO::FETCH_ASSOC);
			$result->closeCursor();
			return $project;
		}
	}

	public function addProject($title, $type, $link, $githubLink, $pictureName, $description)
	{
		$sql = 
			"INSERT INTO projects (title, type, link, githubLink, pictureName, description)
			VALUES ('$title', '$type', '$link', '$githubLink', '$pictureName', '$description')";
		$addProject = $this->dataBase->createRequest($sql);
	}

	public function editProject($projectID, $title, $type, $link, $githubLink, $pictureName, $description)
	{
		$sql = 
			"UPDATE projects
			SET title = '$title',
				type = '$type',
				link = '$link',
				githubLink = '$githubLink',
				pictureName = '$pictureName',
				description = '$description'
			WHERE ID = '$projectID'";
		$editProject = $this->dataBase->createRequest($sql);
	}

	public function deleteProject($projectID)
	{
		$sql = 
			"DELETE FROM projects
			WHERE ID = ?";
		$deleteComment = $this->dataBase->createRequest($sql, [$projectID]);
	}
}