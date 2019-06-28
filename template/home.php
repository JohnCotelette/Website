<div id="description"> 
	<div id="homeFilter">
	</div>
	<div id="descriptionContent">
		<div>
			<h1><?=nl2br(htmlspecialchars(stripslashes($siteContent[1]->getBigTitleHeader())));?></h1>
			<h2><?=nl2br(htmlspecialchars(stripslashes($siteContent[1]->getSmallTitleHeader())));?></h2>
		</div>
		<div class="internalNav white">
			<span><a class="defaultA" href="#projectsTarget"><img src="img/fbla.png" class="projectsNav" alt="Flèche de navigation - A propos" /></a></span>
			<p>
				Mes projets
			</p>
		</div>
	</div>
</div>

<section id="projects">
	<span id="projectsTarget"></span>
	<h3>Projets</h3>
	<hr />
	<div id="projectsSelectors">
		<button id="all" class="projectsSelectors selected">All</button>
		<button id="CMS" class="projectsSelectors">From scratch</button>
		<button id="fromScratch" class="projectsSelectors">CMS</button>
	</div>
	<div id="projectsContainer">
<?php forEach($projects as $project) : ?>
		<div class="projectsBlocks <?=$project->getType();?>">
			<div class="projectsFilters projectsFilters<?=$project->getType();?>">
				<p>
					<?=$project->getType();?>
				</p>
			</div>
			<div class="projectsDescriptions">
				<div>
					<p class="projectsTitles">
						<?=nl2br(htmlspecialchars(stripslashes($project->getTitle())));?>
					</p>
					<p class="projectsText">
						<?=nl2br(htmlspecialchars(stripslashes($project->getDescription())));?>
					</p>
					<div class="projectsViewContainer">
						<p class="projectsView">
							<span>
	<?php if (!empty($project->getGithubLink())) : ?>
								<a class="projectsLinks out" href="<?=$project->getGithubLink();?>" target="_blank"><i class="far fa-eye"></i></a><br />
								Voir le code
	<?php endif; ?>
							</span>
							<span><a class="projectsLinks out" href="<?=$project->getLink();?>" target="_blank"><i class="far fa-eye"></i></a><br />
								Voir le projet</span>
						</p>
					</div>
				</div>
			</div>
			<figure>
				<img class="imgProjects" src="img/<?=$project->getPictureName();?>.jpg" alt="Photo d'illustration projet <?=$project->getTitle();?>" />
			</figure>
		</div>
<?php endforeach; ?>
	</div>
	<div class="internalNav">
		<span><a class="defaultA" href="#aboutTarget"><img src="img/fble.png" class="aboutNav" alt="Flèche de navigation - A propos" /></a></span>
		<p>
			A propos
		</p>
	</div>
</section>

<section id="about">
	<span id="aboutTarget"></span>
	<h3>A propos</h3>
	<hr />
	<div id="cvContainer">
		<div id="scrollBar">
			<div id="progressScrollBar">
				<span id="point"></span>
			</div>
		</div>
		<div id="rightC">
			<p id="identity">
				<?=nl2br(htmlspecialchars(stripslashes($siteContent[1]->getCVDesc())));?>
			</p>

			<div id="skillsContainer">
<?php forEach($skills as $skill) : ?>
				<div class="skills" id="<?=stripslashes($skill->getTitle());?>">
					<img class="skillsImgs" src="img/<?=stripslashes($skill->getPictureName());?>.svg" alt="<?=stripslashes($skill->getTitle());?>" />
					<div class="skillsBarsContainers">
						<div class="skillsBars">
							<div class="progressSkillsBars" style="width: <?=$skill->getProgress();?>%;">
							</div>
						</div>
					</div>
				</div>
<?php endforeach; ?>
			</div>
			<p id="more">
				<span id="moreContent"><?=nl2br(htmlspecialchars(stripslashes($siteContent[1]->getCVDescMore())));?></span>
				<span id="moreContentForHeight"><?=nl2br(htmlspecialchars(stripslashes($siteContent[1]->getCVDescMore())));?></span>
			</p>
			<p id="cvLinkContainer">
				<a id="cvLink" href="doc/cv.pdf" download="CV - Samuel Darras.pdf">Télécharger CV</a>
			</p>
		</div>
	</div>

	<div class="internalNav">
		<span>
			<a class="defaultA" href="#contactTarget"><img src="img/fbla.png" class="contactNav" alt="Flèche de navigation - A propos" /></a>
		</span>
		<p>
			Contact
		</p>
	</div>
</section>

<section id="contact">
	<span id="contactTarget"></span>
	<h3>Contact</h3>
	<hr />
	<div id="contactContainer">
		<div id="formContact">
			<form id="form">
				<p id="formDesc">
					Pour toute question éventuelle, vous pouvez me contacter via le formulaire ci dessous.<br/>
					Je reviendrai vers vous au plus vite.
				</p>
				<p>
					<input type="text" id="formName" class="formInputs" name="formName" placeholder="Nom*" maxlength="50" required />
					<input type="text" id="formSurname" class="formInputs" name="formSurname" placeholder="Prénom*" maxlength="50" required />
				</p>
				<p>
					<input type="email" id="formEmail" class="formInputs" name="formEmail" placeholder="Email*" maxlength="80" required />
				</p>
				<p>
					<input type="text" id="formSubject" class="formInputs" name="formSubject" placeholder="Sujet*" maxlength="100" required />
				</p>
				<p>
					<textarea id="formContent" class="formInputs" name="formContent" placeholder="Votre Message*" maxlength="1000" required></textarea>
				</p>
				<p id="formSubmitContainer">
					<input type="submit" id="formSubmit" class="formInputs" name="formSubmit" value="Envoyer" />
				</p>
				<p id="sendConfirm" class="invisible">
					<span>Votre message a bien été envoyé !</span>
				</p>
			</form>
		</div>
		<div id="classicContact">
			<div>
				<p id="or">
					Une autre possibilité s'offre à vous :
				</p>
				<div id="coord">
					<p>
						<img src="img/phone.svg" alt="Téléphone: " /><span>au <?=$siteContent[1]->getPhoneNumber();?>.</span>
					</p>
				</div>
				<div id="jsInfo">
					<p>
						Javascript doit être activé dans votre navigateur pour que ce site fonctionne correctement.<br />
						Sans cela, le formulaire ne produira pas son effet.
					</p>
				</div>
			</div>
		</div>
	</div>
</section>