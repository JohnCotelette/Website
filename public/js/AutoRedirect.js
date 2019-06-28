class AutoRedirect
{
	constructor()
	{
		this.counterHTML = document.getElementById("count");
		this.plurialOrSingular = document.getElementById("plurialOrSingular");

		this.speed = 1000;
		this.counter = 5;
	};

	displayCounter()
	{
		let intervalID = setInterval(() =>
		{
			this.counter --;
			this.counterHTML.textContent = this.counter;
			if (this.counter <= 1)
			{
				this.plurialOrSingular.textContent = "";
			}
			if (this.counter == 0)
			{
				clearInterval(intervalID);
				this.redirect();
			};
		}, this.speed);
	};

	redirect()
	{
		window.location.replace("index.php");
	};

	init()
	{	
		this.displayCounter();
	};
};

let newAutoRedirect = new AutoRedirect;
newAutoRedirect.init();