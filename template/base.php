<?php
use App\Src\Utility\AddCssScripts;
?>

<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
		<link rel="stylesheet" href="css/main.css" />
<?php forEach($css as $style) : echo AddCssScripts::addCss($style); endforeach; ?>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="icon" type="image/png" href="img/fav.png" />
		<title><?=$title?></title>
		<meta name="description" content="Développement Web sur le secteur de Lille et alentours, vous pouvez consulter mon portefolio et me contacter via cette page." />
<!-- Facebook -->
		<meta property="og:type" content="website" />
		<meta property="og:url" content="https://www.samueldarras.com" />
		<meta property="og:title" content="<?=$title?>">
		<meta property="og:description" content="Développement Web sur le secteur de Lille et alentours, vous pouvez consulter mon portefolio et me contacter via cette page." />
		<meta property="og:image" content="https://www.samueldarras.com/img/shareImg.jpg" />
<!-- Twitter -->
		<meta property="twitter:card" content="summary_large_image" />
		<meta property="twitter:url" content="https://www.samueldarras.com" />
		<meta property="twitter:title" content="<?=$title?>" />
		<meta property="twitter:description" content="Développement Web sur le secteur de Lille et alentours, vous pouvez consulter mon portefolio et me contacter via cette page." />
		<meta property="twitter:image" content="https://www.samueldarras.com/img/shareImg.jpg" />
	</head>

	<body>
		<div id="totalPageContent">
			<header>
				<div id="headerTitle">
					<a href="index.php">Samuel Darras</a>
				</div>
				<a id="hamburger" href="#"><i class="fas fa-bars"></i></a>
				<nav id="menu">
					<?=$header;?>
					<a href="#" id="exitMobileMenu" class="invisible"><i class="far fa-times-circle"></i></a>
				</nav>
			</header>
			<main id="pageContent">
				<?=$content;?>
			</main>
		</div>
<?php forEach($scripts as $script) : echo AddCssScripts::addScript($script); endforeach; ?>
	</body>
</html>