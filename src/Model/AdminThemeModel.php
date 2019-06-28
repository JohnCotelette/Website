<?php
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\AdminTheme;
use Exception;
use PDO;


class AdminThemeModel extends Model
{
	private function buildObject($row)
	{
		$adminTheme = new AdminTheme;
		$adminTheme->setID($row["ID"]);
		$adminTheme->setName($row["name"]);
		$adminTheme->setBackgroundColor($row["backgroundColor"]);
		$adminTheme->setBackgroundColorSections($row["backgroundColorSections"]);
		$adminTheme->setBackgroundColorContent($row["backgroundColorContent"]);
		$adminTheme->setBackgroundColorButtons($row["backgroundColorButtons"]);
		$adminTheme->setTextColor($row["textColor"]);
		$adminTheme->setStatus($row["status"]);
		return $adminTheme;
	}

	public function getThemes()
	{
		$sql =
			"SELECT ID, name, backgroundColor, backgroundColorSections, backgroundColorContent, backgroundColorButtons, textColor, status
			FROM admin_themes";
		$result = $this->dataBase->createRequest($sql);
		$adminThemes = [];
		forEach($result as $row)
		{
			$adminThemeID = $row["ID"];
			$adminThemes[$adminThemeID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $adminThemes;
	}

	public function getThemeSelected()
	{
		$sql =
			"SELECT name
			FROM admin_themes
			WHERE status = 1";
		$result = $this->dataBase->createRequest($sql);
		$themeSelected = $result->fetch();
		$result->closeCursor();
		return $themeSelected[0];
	}

	public function getThemeSelectedCss($newThemeID)
	{
		$sql =
			"SELECT ID, name, backgroundColor, backgroundColorSections, backgroundColorContent, backgroundColorButtons, textColor, status
			FROM admin_themes
			WHERE ID = ?";
		$themeSelectedCss = $this->dataBase->createRequest($sql, [$newThemeID]);
		$themeSelectedCss = $themeSelectedCss->fetch(PDO::FETCH_ASSOC);
		return $themeSelectedCss;
	}

	public function changeTheme($oldThemeID, $newThemeID)
	{
		$sql =
			"UPDATE admin_themes
			SET status = 0
			WHERE ID = ?";
		$oldTheme = $this->dataBase->createRequest($sql, [$oldThemeID]);
		$sql =
			"UPDATE admin_themes
			SET status = 1
			WHERE ID = ?";
		$newTheme = $this->dataBase->createRequest($sql, [$newThemeID]);
	}
}
