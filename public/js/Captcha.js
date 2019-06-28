class Captcha 
{
	constructor()
	{
		this.captcha = document.getElementById("captcha");
		this.captchaNumber1 = document.getElementById("captchaNumber1");
		this.captchaNumber2 = document.getElementById("captchaNumber2");
		this.captchaResult = document.getElementById("captchaResult");
		this.captchaValidator = document.getElementById("captchaValidator");
		this.form = document.getElementById("form");
		this.n1 = null;
		this.n2 = null;
		this.autorisation = "false";
	};

	init()
	{
		this.n1 = Math.floor(Math.random() * 10);
		this.n2 = Math.floor(Math.random() * 10);
		this.captchaNumber1.textContent = this.n1;
		this.captchaNumber2.textContent = this.n2;
		this.captchaResult.value = "";
	};

	check()
	{
		if(this.captchaResult.value == (this.n1 + this.n2))
		{
			this.captcha.classList.add("invisible");
			this.form.classList.remove("invisible");
			this.autorisation = "true";
		}
		else 
		{
			alert("Le résultat n'est pas correct !");
		};
	};

	initControls()
	{
		this.captchaValidator.addEventListener("click", (e) => {
			this.check();
		});
	};
};