<ul id="internLinks">
	<li class="links"><a class="defaultA" href="index.php">Accueil</a></li>
<?php if (!empty($_SESSION)) : ?>
	<li class="links adminLinksContainers" id="adminReturn"><a id="adminReturnPage" href="index.php?admin">Retour administration</a></li>
	<li class="links adminLinksContainers"><a id="disconnectLink" href="index.php?adminDisconnect">Déconnexion</a></li>
<?php endif; ?>
</ul>
<ul id="externLinks">
	<li><a href="https://github.com/JohnCotelette" target="_blank" class="icons links"><i class="fab fa-github-square"></i></a></li>
	<li><a href="https://fr.linkedin.com/in/samueldarras" target="_blank" class="icons links"><i class="fab fa-linkedin"></i></a></li>
</ul>