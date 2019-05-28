<?php
namespace App\Src\Utility;

class FormattingHelper
{
	static private $dateFR;

	static public function cutTheContentProperly($content)
	{
		if (strlen($content) >= 600)
		{
			$content = substr($content, 0, 300);
			$content = substr($content, 0, strrpos($content, " "));
			$content = $content . " [...]";
		}
		return $content;
	}

	static public function cutExtension($content)
	{
		$contentWithoutExt = substr($content, 0, strrpos($content, "."));
		return $contentWithoutExt;
	}

	static public function countOnlyCharacters($content)
	{
		$contentWithoutRTR = preg_replace("#\n|\t|\r#","", $content);
		$contentWithOnlyCharacters = str_replace(" ", "", $contentWithoutRTR);
		$realLengthContent = strlen($contentWithOnlyCharacters);
		return $realLengthContent;
	}

	static public function singularOrPluralCorrector($word, $number)
	{
		if($number < 2)
		{
			$word = substr($word, 0, -1);
			return $word;
		}
		else
		{
			return $word; 
		}
	}

	static public function convertDateToFR($date)
	{
		$dateWithOnlySpace = str_replace(array("-", ":"), " ", $date);
		list($year, $month, $day, $hour, $minute, $seconde) = explode(" ", $dateWithOnlySpace);
		$monthFR; $hourFR;

		switch ($month)
		{
			case "01":
			$monthFR = "Janvier";
			break;
			case "02":
			$monthFR = "Février";
			break;
			case "03":
			$monthFR = "Mars";
			break;
			case "04":
			$monthFR = "Avril";
			break;
			case "05":
			$monthFR = "Mai";
			break;
			case "06":
			$monthFR = "Juin";
			break;
			case "07":
			$monthFR = "Juillet";
			break;
			case "08":
			$monthFR = "Aout";
			break;
			case "09":
			$monthFR = "Septembre";
			break;
			case "10":
			$monthFR = "Octobre";
			break;
			case "11":
			$monthFR = "Novembre";
			break;
			case "12":
			$monthFR = "Décembre";
			break;
		}

		switch ($hour)
		{
			case "00":
			$hourFR = "minuit";
			break;
			case "01":
			$hourFR = $hour . " " . "heure";
			default:
			$hourFR = $hour . " " . "heures";
		}

		$dateFR = $day . " " . $monthFR . " " . $year . " - " . " A " . $hourFR . " " . $minute;
		return static::$dateFR = $dateFR;
	}

	static public function getSimplefiedDateConvertedFR($date)
	{
		static::convertDateToFR($date);
		list($dateSimplified, $uselessPart) = explode("-", static::$dateFR);
		return $dateSimplified;
	}
}