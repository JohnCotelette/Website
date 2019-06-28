<?php
use App\Src\Utility\FormattingHelper;
?>

<div class="sectionTitles" id="firstSection">
	<a class="categories adminLinks" id="one" href="">Messagerie<i class="fas fa-sort-up bigArrows arrows"></i></a>
</div>

<section id="adminMessages" class="adminSections">
	<div class="containers">
		<a class="smallCategories adminLinks" href="">Liste des messages (<?=$totalMessages;?>)<i class="fas fa-sort-up smallArrows arrows"></i></a>
		<div id="messagesList" class="smallContents invisible">
<?php if ($_SESSION["adminRights"] > 1) : ?>
	<?php if ($totalMessages > 0) : ?>
			<div id="totalMessagesContainer">
		<?php forEach($messages as $message) : ?>
				<div class="messagesContainers" data-messageID="<?=$message->getID();?>">
					<h2>Auteur</h2>
					<p class="messages">
						<?=htmlspecialchars(stripslashes($message->getIdentity()));?>
					</p>
					<h2>Reçu le</h2>
					<p class="messages">
						<?=FormattingHelper::getSimplefiedDateConvertedFR($message->getDate());?>
					</p>
					<h2>Adresse de contact</h2>
					<p class="messages">
						<?=htmlspecialchars(stripslashes($message->getEmail()));?>
					</p>
					<h2>Sujet</h2>
					<p class="messages">
						<?=htmlspecialchars(stripslashes($message->getSubject()));?>
					</p>
					<h2>Contenu</h2>
					<p class="messages">
						<?=nl2br(htmlspecialchars(stripslashes($message->getContent())));?>
					</p>
					<button class="buttons deleteMessageButtons" data-messageID="<?=$message->getID();?>">Effacer</button>
				</div>
				<hr class="messagesHr" data-messageID="<?=$message->getID();?>">
		<?php endforeach; ?>
			</div>
	<?php else : ?>
			<p id="noMessages">
				Vous n'avez aucun message enregistré dans la base de données.
			</p>
	<?php endif; ?>
<?php else : ?>
			<p class="errorRights">
				Vous ne disposez pas des droits administrateur suffisants pour gérer cette section du site.
			</p>
<?php endif; ?>
		</div>
	</div>
</section>

<div class="sectionTitles">
	<a class="categories adminLinks" id="one" href="">Contenu du site<i class="fas fa-sort-up bigArrows arrows"></i></a>
</div>

<section id="adminSiteContent" class="adminSections">
	<div class="containers">
		<a class="smallCategories adminLinks" href="">Personnalisation partie publique<i class="fas fa-sort-up smallArrows arrows"></i></a>
		<div id="siteContentCustom" class="smallContents invisible">
<?php if($_SESSION["adminRights"] > 0) : ?>
			<h2>Modification du contenu textuel</h2>
			<form id="textCustomForm">
				<div>
					<p>
						<label for="bigTitleHeader">Gros titre*</label>
						<textarea id="bigTitleHeader" class="smallTextarea" name="bigTitleHeader" maxlength="70" required><?=$siteContent[1]->getBigTitleHeader();?></textarea>
					</p>
					<p>
						<label for="smallTitleHeader">Sous titre*</label>
						<textarea id="smallTitleHeader" class="smallTextarea" name="smallTitleHeader" maxlength="70" required><?=$siteContent[1]->getSmallTitleHeader();?></textarea>
					</p>
				</div>
				<p>
					<label for="cvDesc">Description CV*</label>
					<textarea id="cvDesc" class="bigTextarea" name="cvDesc" required><?=$siteContent[1]->getCVDesc();?></textarea>
				</p>
				<p>
					<label for="cvDescMore">Description détaillée CV*</label>
					<textarea id="cvDescMore" class="bigTextarea" name="cvDescMore" required><?=$siteContent[1]->getCVDescMore();?></textarea>
				</p>
				<div>
					<p>
						<label for="contactEmail">Email*</label>
						<textarea id="contactEmail" class="smallTextarea" name="contactEmail" required><?=$siteContent[1]->getEmail();?></textarea>
					</p>
					<p>
						<label for="phoneNumber">Téléphone*</label>
						<textarea id="contactPhoneNumber" class="smallTextarea" name="contactPhoneNumber" required><?=$siteContent[1]->getPhoneNumber();?></textarea>
					</p>
				</div>
				<p>
					<input type="submit" id="submitTextCustomForm" class="buttons" value="Modifier" />
				</p>
			</form>
			<hr class="siteContentCustomHr">
			<h2>Progression des compétences</h2>
			<form id="skillsCustomForm">
				<div id="skillsList">
	<?php forEach($skills as $skill) : ?>
					<p>
						<label for="<?=$skill->getTitle();?>"><?=$skill->getTitle();?></label>
						<input type="text" name="<?=stripslashes($skill->getTitle());?>" value="<?=$skill->getProgress();?>" maxlength="2" />
					</p>
	<?php endforeach; ?>
				</div>
				<p>
					<input type="submit" id="submitSkillsCustomForm" class="buttons" value="Modifier" />
				</p>
			</form>
			<hr class="siteContentCustomHr">
			<h2>Ajout/Modification/Suppression des projets</h2>
			<div id="projectsContainer">
	<?php forEach($projects as $project) : ?>
				<div class="projectsContainers">
					<p class="projectsPictures">
						<img src="img/<?=$project->getPictureName();?>.jpg" alt="<?=$project->getPictureName();?>" />
					</p>
					<p class="projectsTitles">
						<span><?=stripslashes($project->getTitle());?></span>
					</p>
					<p class="projectsControllers">
						<button class="buttons editProjectButtons" data-projectID="<?=$project->getID();?>">Modifier</button>
						<button class="buttons deleteProjectButtons" data-projectID="<?=$project->getID();?>">Supprimer</button>
					</p>
				</div>
	<?php endforeach; ?>
				<hr class="siteContentCustomHr">
				<form id="projectsForm">
					<p id="mod">
						<span id="modIndicatorTarget"></span>
						<span id="modType">Mode ajout</span>
					</p>
					<p>
						<label for="projectTitle">Titre du projet*</label>
						<input type="text" name="projectTitle" id="projectTitle" maxlength="120" required />
					</p>
					<p>
						<label id="projectPictureNameLabel" for="projectPictureName">Image*</label>
						<input type="file" accept="image/jpg" name="projectPicture" required />
						<span id="lastPictureName" class="invisible"></span>
					</p>
					<p>
						<label for="projectType">Type*</label>
						<select name="projectType" required>
							<option value="">--Selection type--</option>
							<option value="fromScratch">From Scratch</option>
							<option value="CMS">CMS</option>
						</select>
					</p>
					<p>
						<label for="projectLink">Lien*</label>
						<input type="text" name="projectLink" maxlength="240" required />
					</p>
					<p>
						<label for="projectGithubLink">Lien Github</label>
						<input type="text" name="projectGithubLink" class="projectsLinks" maxlength="240" />
					</p>
					<p>
						<label for="projectDesc">Description*</label>
						<textarea name="projectDesc" maxlength="500" required></textarea>
					</p>
					<div id="projectsFormControllers">
						<p>
							<input type="submit" class="buttons" id="submitProjectsAddForm" value="Ajouter" />
						</p>
						<p>
							<a id="changeMod" class="buttons invisible">Mode ajout <i class="fas fa-arrow-circle-right"></i></a>
						</p>
				</form>
			</div>
<?php else : ?>
			<p class="errorRights">
				Vous ne disposez pas des droits administrateur suffisants pour gérer cette section du site.
			</p>
<?php endif; ?>
		</div>
	</div>
</section>

<div class="sectionTitles">
	<a class="categories adminLinks" id="two" href="">Gestion des administrateurs<i class="fas fa-sort-up bigArrows arrows"></i></a>
</div>

<section id="adminAddAndRemove" class="adminSections">
	<div class="containers">
		<a class="smallCategories adminLinks" href="">Liste des administrateurs (<?=$totalAdmins;?>)<i class="fas fa-sort-up smallArrows arrows"></i></a>
		<div id="adminsList" class="smallContents invisible">
<?php if ($_SESSION["adminRights"] > 0) : ?>
		<div id="headerAdmins">
			<p id="pAdminID">
				ID admin
			</p>
			<p id="pAdminPseudo">
				Pseudo
			</p>
			<p id="pAdminRights">
				Droits
			</p>
			<p id="pAdminManage">
				Suppression
			</p>
		</div>
	<?php forEach($admins as $admin) : ?>
			<div class="adminsList">
				<p class="pAdminID">
					<?=$admin->getID();?>
				</p>
				<p class="pAdminPseudo">
					<?=htmlspecialchars($admin->getName());?>
				</p>
				<p class="pAdminRights">
		<?php if($admin->getRights() == 2) : ?>					
					Propriétaire du site
		<?php elseif($admin->getRights() == 1) : ?>
					Administrateur
		<?php else : ?>
					Testeur
		<?php endif; ?>
				</p>
				<p class="pAdminManage">
		<?php if ($admin->getRights() < 2 && $_SESSION["adminRights"] > 0) : ?>
					<input type="button" data-adminID="<?=$admin->getID();?>" class="adminButtonsDelete buttons" value="Supprimer" />
		<?php endif; ?>
				</p>
			</div>
			<hr class="adminsHr">
	<?php endforeach; ?>
			<p id="pAdminAdd">
				<span class="style">Ajouter un administrateur ou un modérateur</span>
			</p>
			<form id="addAdmin" method="post">
				<p>
					<label for="pseudo">Pseudo*</label>
					<input type="text" name="addAdminPseudo" id="pseudoAdmin" class="inputsAdmin" maxlength="200" required />
				</p>
				<p>
					<label for="password">Mot de passe*</label>
					<input type="text" name="addAdminPassword" id="passwordAdmin" class="inputsAdmin" maxlength="200" required/>
				</p>
				<p>
					<label for="rights">Droits*</label>
					<select name="addAdminRights" id="rights" class="inputsAdmin" required>
						<option value="">--Selection droits--</option>
						<option value="administrateur">Administrateur</option>
						<option value="testeur">Testeur</option>
					</select>
				</p>
				<p id="submitAdminContainer">
					<input type="submit" id="submitAdmin" class="buttons" value="Ajouter" />
				</p>
			</form>
<?php else : ?>
			<p class="errorRights">
				Vous ne disposez pas des droits administrateur suffisants pour gérer cette section du site.
			</p>
<?php endif; ?>
		</div>
	</div>
</section>

<div class="sectionTitles">
	<a class="categories adminLinks" id="three" href="">Préférences<i class="fas fa-sort-up bigArrows arrows"></i></a>
</div>

<section id="adminThemes" class="adminSections">
	<div class="containers">
		<a class="smallCategories adminLinks" href="">Choix thème (<?=$totalAdminThemes;?>)<i class="fas fa-sort-up smallArrows arrows"></i></a>
		<div class="smallContents invisible">
			<form id ="themesForm">
				<p id="themeChoicesContainer">
<?php forEach($adminThemes as $adminTheme) : ?>
					<span><input type="radio" name="themeChoices" class="themeChoices" value="<?=$adminTheme->getName();?>" data-themeID="<?=$adminTheme->getID();?>" <?php if ($adminTheme->getStatus() == 1) { ?> checked <?php } ?> />
					<label for="<?=$adminTheme->getName();?>"><?=$adminTheme->getName();;?></label></span>
<?php endforeach; ?>
				</p>
				<p id="themesFormSubmitContainer">
					<input type="submit" id="submitTheme" class="buttons" value="Changer" />
				</p>
			</form>
		</div>
	</div>
</section>