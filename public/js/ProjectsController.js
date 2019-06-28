class ProjectsController 
{
	constructor()
	{
		this.projects = document.getElementsByClassName("projectsBlocks");
		this.projectsFromScratch = document.getElementsByClassName("fromScratch");
		this.projectsCMS = document.getElementsByClassName("CMS");
		this.projectsImg = document.getElementsByClassName("imgProjects");
		this.projectsDescriptions = document.getElementsByClassName("projectsDescriptions");
		this.projectsLinks = document.getElementsByClassName("projectsLinks");

		this.projectsFilters = document.getElementsByClassName("projectsFilters");
		this.projectsFiltersCMS = document.getElementsByClassName("projectsFiltersCMS");
		this.projectsFiltersFromScratch = document.getElementsByClassName("projectsFiltersfromScratch");

		this.projectsSelectors = document.getElementsByClassName("projectsSelectors");
		this.projectsSelectorAll = document.getElementById("all");
		this.projectsSelectorCMS = document.getElementById("CMS");
		this.projectsSelectorFromScratch = document.getElementById("fromScratch");
	};

	transformEvent(e, i) {
		let typeE = e.type;
		if (typeE === "touchstart") {
			var mouseEvent = new MouseEvent("mouseover", {});
			this.projects[i].dispatchEvent(mouseEvent);
			this.hideDescriptions();
			this.showDescription(i);
		};
	};

	hideDescriptions()
	{
		for (let i = 0; i < this.projects.length; i++)
		{
			this.projectsDescriptions[i].style.top = "100%";
			this.projectsDescriptions[i].style.opacity = "0";
			this.projectsImg[i].style.transform = "scale(1)";
		};

		for (let i = 0; i < this.projectsLinks.length; i++)
		{
			this.projectsLinks[i].classList.add("out");
		};
	};

	showDescription(projectBlock)
	{
		this.projectsDescriptions[projectBlock].style.top = "0";
		this.projectsDescriptions[projectBlock].style.opacity = "1";
		this.projectsImg[projectBlock].style.transform = "scale(1.15)";

		for (let i = 0; i < this.projectsLinks.length; i++)
		{
			this.projectsLinks[i].classList.remove("out");
		};
	};

	resetDisplay()
	{
		for (let i = 0; i < this.projectsSelectors.length; i++)
		{
			this.projectsSelectors[i].classList.remove("selected");
		};

		for (let i = 0; i < this.projects.length; i++)
		{
			this.projectsFilters[i].style.top = "-100%";
			this.projectsFilters[i].style.opacity = "0";
		};
	};

	displayProjects(type)
	{
		let projectsType = null;
		let projectsFilters = null;
		if (type === "CMS")
		{
			projectsType = this.projectsFromScratch;
			projectsFilters = this.projectsFiltersFromScratch;
		}
		else
		{
			projectsType = this.projectsCMS;
			projectsFilters = this.projectsFiltersCMS;
		};

		for (let i = 0; i < projectsType.length; i++)
		{
			projectsFilters[i].style.top = "0";
			projectsFilters[i].style.opacity = "1";
		};
	};

	displayButtons(i)
	{
		this.projectsSelectors[i].classList.add("selected");
	};

	initControls()
	{
		for (let i = 0; i < this.projects.length; i++)
		{
			this.projects[i].addEventListener("mouseout", () => 
			{
				this.hideDescriptions();
			});

			this.projects[i].addEventListener("mouseover", () => 
			{
				this.showDescription(i);
			});

			this.projects[i].addEventListener("touchstart", (e) =>
			{
				this.transformEvent(e, i);
			}); 
		};

		for (let i = 0; i < this.projectsSelectors.length; i++)
		{
			this.projectsSelectors[i].addEventListener("click", () =>
			{
				this.hideDescriptions();
				this.resetDisplay();
				this.displayButtons(i);
			});
		};

		this.projectsSelectorFromScratch.addEventListener("click", () => 
		{
			this.displayProjects("CMS");
		});

		this.projectsSelectorCMS.addEventListener("click", () => 
		{
			this.displayProjects("fromScratch");
		});
	};
};

let newProjectsController = new ProjectsController;
newProjectsController.initControls();