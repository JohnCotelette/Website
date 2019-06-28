<p id="error">
		Les identifiants sont invalides.
</p>
<form id="form" class="invisible" method="post" action="#">
	<p id="pName">
		<label class="labels" for="pseudo">Pseudo</label>
		<input type="text" id="pseudo" name="pseudo" required />
	</p>
	<p id="pPassword">
		<label class="labels" for="password">Mot de passe</label>
		<input type="password" id="password" name="password" required />
	</p>
	<p>
		<input type="submit" class="buttons" id="submit" name="submit" value="Se connecter" />
	</p>
</form>

<div id="captcha" class="">
	<p>
		<span id="captchaNumber1"></span> plus <span id="captchaNumber2"></span> font :
		<input type="text" name="captchaResult" id="captchaResult" maxlength="2" />
	</p>
	<button id="captchaValidator" class="buttons">Valider le résultat</button>
</div>
