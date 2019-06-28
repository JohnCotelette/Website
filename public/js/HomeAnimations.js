class HomeAnimations
{
	constructor()
	{
		this.sections = document.getElementsByTagName("section");
		this.separators = document.getElementsByTagName("hr");
		this.sectionsTitles = document.getElementsByTagName("h3");

		this.projects = document.getElementsByClassName("projectsBlocks");
		this.projectsSelectors = document.getElementsByClassName("projectsSelectors");
		this.projectsSelectorsContainer = document.getElementById("projectsSelectors");

		this.centerPoint = document.getElementById("point");
		this.aboutScrollBar = document.getElementById("scrollBar");
		this.aboutProgressScrollBar = document.getElementById("progressScrollBar");
		this.cvIdentity = document.getElementById("identity");
		this.cvSkillsContainer = document.getElementById("skillsContainer");
		this.cvSkills = document.getElementsByClassName("skills");
		this.cvSkillsProgressBars = document.getElementsByClassName("progressSkillsBars");
		this.cvMore = document.getElementById("moreContent");
		this.cvMoreContent = document.getElementById("moreContent").textContent;
		this.cvLinkContainer = document.getElementById("cvLinkContainer");

		this.contactLeftBlock = document.getElementById("formContact");
		this.contactRightBlock = document.getElementById("classicContact");
		this.formInputs = document.getElementsByClassName("formInputs");
		this.coordContent = document.getElementById("coord");
		this.jsInfoContent = document.getElementById("jsInfo");

		this.aboutProgressScrollBarAnimatedState = true;
		this.projectsSelectorsAnimatedState = false;
		this.separatorsAnimatedState = false;
		this.projectsAnimatedState = false;
		this.sectionsTitlesAnimatedState = false;
		this.titlesAndSeparatorsAnimatedState = false;
		this.cvIdentityAnimatedState = false;
		this.cvSkillsAnimatedState = false;
		this.cvMoreAnimatedState = false;
		this.cvLinkAnimatedState = false;
		this.contactAnimatedState = false;

		this.projectsAnimated = null;
		this.separatorsAnimated = null;
		this.sectionsTitlesAnimated = null;

		this.windowHeight = window.innerHeight;

		this.letterSelected = 0;
		this.speed = 5;
	};

	checkPositionAndAnimate()
	{
		this.windowHeight = window.innerHeight;

		if (this.projectsAnimatedState == false)
		{
			this.animateProjects();
		};

		if (this.titlesAndSeparatorsAnimatedState == false)
		{
			this.animateTitlesAndSeparators();
		};

		if (this.projectsSelectorsAnimatedState == false)
		{
			this.animateProjectsSelectors();
		};

		if (this.cvIdentityAnimatedState == false)
		{
			this.animateCVIdentity();
		};

		if (this.cvSkillsAnimatedState == false)
		{
			this.animateCVSkills();
		};

		if (this.cvMoreAnimatedState == false)
		{
			this.animateCVMore();
		};

		if (this.cvLinkAnimatedState == false)
		{
			this.animateCVLink();
		};

		if (this.contactAnimatedState == false)
		{
			this.animateContact();
		};

		this.animateProgressScrollBar();
	};

	animateProjects()
	{
		for (let i = 0; i < this.projects.length; i++) 
		{
			let positionFromTopProjects = this.projects[i].getBoundingClientRect().top;
			if (positionFromTopProjects - this.windowHeight <= 0) 
			{
				this.projects[i].classList.add("popWithFadeInTop");
				this.projectsAnimated = document.getElementsByClassName("popWithFadeInTop");
				if (this.projectsAnimated.length === this.projects.length)
				{
					this.projectsAnimatedState = true;
				};
			};
		};
	};

	animateTitlesAndSeparators()
	{
		for (let i = 0; i < this.sections.length; i++) 
		{
			if (this.separatorsAnimatedState == false)
			{
				let positionFromTopSeparators = this.separators[i].getBoundingClientRect().top;
				if (positionFromTopSeparators - this.windowHeight <= 0) 
				{
					this.separators[i].className = this.separators[i].className.replace("small", "bigger");
					this.separatorsAnimated = document.getElementsByClassName("bigger");
					if (this.separatorsAnimated.length === this.sections.length)
					{
						this.separatorsAnimatedState = true;
					};
				};
			};

			if (this.sectionsTitlesAnimatedState == false)
			{
				let positionFromTopSectionsTitles = this.sectionsTitles[i].getBoundingClientRect().top;
				if (positionFromTopSectionsTitles - this.windowHeight <= 0) 
				{
					this.sectionsTitles[i].classList.add("pop");
					this.sectionsTitles[i].classList.add("titlesAnimated");
					this.sectionsTitlesAnimated = document.getElementsByClassName("titlesAnimated");
					if (this.sectionsTitlesAnimated.length === this.sections.length)
					{
						this.sectionsTitlesAnimatedState = true;
					};
				};
			};
		};

		if (this.separatorsAnimatedState == true && this.sectionsTitlesAnimatedState == true)
		{
			this.titlesAndSeparatorsAnimatedState = true;
		};
	};

	animateProjectsSelectors()
	{
		let positionFromTopProjectsSelectorsContainer = this.projectsSelectorsContainer.getBoundingClientRect().top;
		if (positionFromTopProjectsSelectorsContainer - this.windowHeight <= 0)
		{
			let i = 0;
			let intervalId = setInterval(() => 
			{
				this.projectsSelectors[i].classList.add("pop");
				i++;
				if (i === this.projectsSelectors.length)
				{
					clearInterval(intervalId);
				};
			}, 350);
			this.projectsSelectorsAnimatedState = true;
		};
	};

	animateProgressScrollBar()
	{
		let scrollBarHeight = this.aboutScrollBar.offsetHeight;
		let progressScrollBarHeight = this.aboutProgressScrollBar.offsetHeight;
		let topPointOfScrollBar = this.aboutScrollBar.getBoundingClientRect().top;
		let topPointPosition = this.centerPoint.getBoundingClientRect().top;
		let calcul = Math.round((topPointOfScrollBar - topPointPosition) * -1);
  		if (calcul < 0)
  		{
  			this.aboutProgressScrollBar.style.height = 0;
  			this.aboutProgressScrollBarAnimatedState = null;
  		}
  		else if (calcul > scrollBarHeight)
  		{
  			this.aboutProgressScrollBar.style.height = "100%";
  			this.aboutProgressScrollBarAnimatedState = null;
  		}
  		else
  		{
  			 this.aboutProgressScrollBar.style.height = calcul + "px";
  			 this.aboutProgressScrollBarAnimatedState = true;
  		};
	};

	animateCVIdentity()
	{
		let positionFromTopCVIdentity = this.cvIdentity.getBoundingClientRect().top;
		if (positionFromTopCVIdentity - this.windowHeight <= 0)
		{
			this.cvIdentity.classList.add("popWithFadeInLeft");
			this.cvIdentityAnimatedState = true;
		};
	};

	animateCVSkills()
	{
		let positionFromTopCVSkills = this.cvSkillsContainer.getBoundingClientRect().top;
		if (positionFromTopCVSkills - this.windowHeight <= 0)
		{
			let i = 0;
			let intervalId = setInterval(() => 
			{
				this.cvSkills[i].classList.add("popWithFadeInLeft");
				this.cvSkillsProgressBars[i].classList.add("progressedSkillBar");
				i++;
				if (i === 5)
				{
					clearInterval(intervalId);
					this.cvSkillsAnimatedState = true;
				};
			}, 380);
		};
	};

	animateCVMore()
	{
		let positionFromTopCVMore = this.cvMore.getBoundingClientRect().top;
		if (positionFromTopCVMore - this.windowHeight <= 0)
		{
			this.typeWriter(this.cvMoreContent, this.cvMore);
			this.cvMoreAnimatedState = true;
		};
	};

	typeWriter(text, target)
	{
		let intervalId = setInterval(() =>
		{
			this.letterAdd();
			if (this.letterSelected === this.cvMoreContent.length)
			{
				clearInterval(intervalId);
			};
		}, 25);
	};

	letterAdd()
	{
		function randomNumber(min, max)
		{
			 return Math.floor(Math.random() * (max - min + 1)) + min;
		};

		this.speed = randomNumber(20, 1000);

		setTimeout(() =>
		{
			this.cvMore.innerHTML += this.cvMoreContent.charAt(this.letterSelected);
			if (this.letterSelected === 140 || this.letterSelected === 288)
			{
				this.cvMore.innerHTML += '<br />';
				this.cvMore.innerHTML += '<br />';
			};
			this.letterSelected ++;
		}, this.speed);
	};

	animateCVLink()
	{
		let positionFromTopCVLink = this.cvLinkContainer.getBoundingClientRect().top;
		if (positionFromTopCVLink - this.windowHeight <= 0)
		{
			this.cvLinkContainer.classList.add("popWithFadeInLeft");
			this.cvLinkAnimatedState = true;
		};
	};

	animateContact()
	{
		let positionFromTopContactSection = this.contactLeftBlock.getBoundingClientRect().top;
		if (positionFromTopContactSection - this.windowHeight <= 0)
		{
			this.contactLeftBlock.classList.add("popWithFadeInRight");
			this.contactRightBlock.classList.add("popWithFadeInLeft");
			let i = 0;
			setTimeout(() =>
			{
				this.coordContent.classList.remove("hidden");
				this.jsInfoContent.classList.remove("hidden");
				this.contactLeftBlock.style.borderRightColor = "rgba(51, 51, 51, 0.2)";
				for (let i = 0; i < this.formInputs.length; i++)
				{
					this.formInputs[i].classList.remove("hidden");
				};
				this.contactAnimatedState = true;
			}, 1400);
		};
	};

	showSections(time)
	{
		return new Promise((resolve) =>
		{
			setTimeout(() =>
			{
				for (let i = 0; i < this.sections.length; i++)
				{
					this.sections[i].classList.remove("invisible");
				};
				resolve();
			}, time);
		});
	};

	initStyles()
	{
		for (let i = 0; i < this.sections.length; i++)
		{
			this.sections[i].classList.add("invisible");
			this.separators[i].classList.add("small");
			this.sectionsTitles[i].style.opacity = "0";
		};

		for (let i = 0; i < this.projects.length; i++)
		{
			this.projects[i].style.opacity = "0";
		};

		for (let i = 0; i < this.projectsSelectors.length; i++)
		{
			this.projectsSelectors[i].style.opacity = "0";
		}

		for (let i = 0; i < this.cvSkills.length; i++)
		{
			this.cvSkills[i].style.opacity = "0";
			this.cvSkillsProgressBars[i].style.maxWidth = "0";
		};

		for (let i = 0; i < this.formInputs.length; i++)
		{
			this.formInputs[i].classList.add("hidden");
		};

		this.cvIdentity.style.opacity = "0";
		this.cvMore.textContent = "";
		this.cvLinkContainer.style.opacity = "0";
		this.contactLeftBlock.style.opacity = "0";
		this.contactRightBlock.style.opacity = "0";
		this.coordContent.classList.add("hidden");
		this.jsInfoContent.classList.add("hidden");
		this.contactLeftBlock.style.borderRightColor = "transparent";
	};

	init()
	{
		this.initStyles();
		this.showSections(2750)
		.then(() =>
		{
			this.initControls();
		});

	};

	initControls()
	{
		window.addEventListener("scroll", this.checkPositionAndAnimate.bind(this));
	};
};

let newHomeAnimations = new HomeAnimations;
newHomeAnimations.init();