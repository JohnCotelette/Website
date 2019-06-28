class HomeNav
{
	constructor()
	{
		this.navProjectsControllers = document.getElementsByClassName("projectsNav");
		this.navAboutControllers = document.getElementsByClassName("aboutNav");
		this.navContactControllers = document.getElementsByClassName("contactNav");

		this.projectsSectionTarget = document.getElementById("projectsTarget");
		this.aboutSectionTarget = document.getElementById("aboutTarget");
		this.contactSectionTarget = document.getElementById("contactTarget");

		this.defaultLinks = document.getElementsByClassName("defaultA");
	};

	scroll(target)
	{
		target.scrollIntoView();
	};

	initControls()
	{
		for (let i = 0; i < this.defaultLinks.length; i++)
		{
			this.defaultLinks[i].addEventListener("click", (e) =>
			{
				e.preventDefault();
			});
		};

		for (let i = 0; i < this.navProjectsControllers.length; i++)
		{
			this.navProjectsControllers[i].addEventListener("click", (e) =>
			{
				this.scroll(this.projectsSectionTarget);
			});
		};

		for (let i = 0; i < this.navAboutControllers.length; i++)
		{
			this.navAboutControllers[i].addEventListener("click", (e) =>
			{
				this.scroll(this.aboutSectionTarget);
			});
		};

		for (let i = 0; i < this.navAboutControllers.length; i++)
		{
			this.navContactControllers[i].addEventListener("click", (e) =>
			{
				this.scroll(this.contactSectionTarget);
			});
		};
	};
};

let newHomeNav = new HomeNav;
newHomeNav.initControls();