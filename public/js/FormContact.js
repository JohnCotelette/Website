class FormContact
{
	constructor()
	{
		this.form = document.getElementById("form");
		this.sendButtonContainer = document.getElementById("formSubmitContainer");
		this.confirmMessage = document.getElementById("sendConfirm");
		this.ajax = new Ajax;
	};

	sendMessage()
	{
		let formData = new FormData(this.form);
		formData.append("jsAuthorization", true);
		this.ajax.sendData("index.php", formData, (response) =>
		{
			if (response === "ok")
			{
				this.displayConfirm();
			}
			else
			{
				return;
			};
		}, "formData");
	};

	displayConfirm()
	{
		this.sendButtonContainer.classList.add("invisible");
		this.confirmMessage.classList.remove("invisible");
		setTimeout(() =>
		{
			this.confirmMessage.classList.add("invisible");
		}, 3200);
	};

	initControls()
	{
		this.form.addEventListener("submit", (e) =>
		{
			e.preventDefault();
			this.sendMessage();
		});
	};
};

let newFormContact = new FormContact;
newFormContact.initControls();