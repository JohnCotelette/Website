<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<link rel="stylesheet" href="css/main.css" />
<?php
if (is_array($css))
	{
		forEach($css as $style)
		{
			echo $style;
		}
	}
else
	{
		echo $css;
	}
?>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="icon" type="image/png" href="" />
		<title><?=$title?></title>
		<meta name="description" content="Développement Web sur le secteur de Lille et alentours, vous pouvez consulter mon portefolio et me contacter via cette page." />
<!-- Facebook -->
		<meta property="og:type" content="website" />
		<meta property="og:url" content="" />
		<meta property="og:title" content="<?=$title?>">
		<meta property="og:description" content="Développement Web sur le secteur de Lille et alentours, vous pouvez consulter mon portefolio et me contacter via cette page." />
		<meta property="og:image" content="" />
<!-- Twitter -->
		<meta property="twitter:card" content="summary_large_image" />
		<meta property="twitter:url" content="" />
		<meta property="twitter:title" content="<?=$title?>" />
		<meta property="twitter:description" content="Développement Web sur le secteur de Lille et alentours, vous pouvez consulter mon portefolio et me contacter via cette page." />
		<meta property="twitter:image" content="" />
	</head>

	<body>
		<div id="totalPageContent">
			<header>
			</header>

			<main id="pageContent">
				<?=$content;?>
			</main>

			<footer id="footer">
			</footer>
		</div>

<?php
if (is_array($scripts))
{
	forEach($scripts as $script)
	{
		echo $script;
	}
}
else
{
	echo $scripts;
}
?>
	</body>
</html>