<ul id="internLinks">
	<li class="projectsNav links"><a class="defaultA" href="#projectsTarget">Projets</a></li>
	<li class="aboutNav links"><a class="defaultA" href="#aboutTarget">A propos</a></li>
	<li class="contactNav links"><a class="defaultA" href="#contactTarget">Contact</a></li>
<?php if (!empty($_SESSION)) : ?>
	<li class="links adminLinksContainers" id="adminReturn"><a id="adminReturnPage" href="index.php?admin">Retour administration</a></li>
	<li class="links adminLinksContainers"><a id="disconnectLink" href="index.php?adminDisconnect">Déconnexion</a></li>
<?php endif; ?>
</ul>
<ul id="externLinks">
	<li><a href="https://github.com/JohnCotelette" target="_blank" class="icons links"><i class="fab fa-github-square"></i></a></li>
	<li><a href="https://fr.linkedin.com/in/samueldarras" target="_blank" class="icons links"><i class="fab fa-linkedin"></i></a></li>
</ul>