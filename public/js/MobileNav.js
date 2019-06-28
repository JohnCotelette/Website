class MobileNav
{
	constructor()
	{
		this.mobileHeader = document.getElementsByTagName("header");
		this.mobileNavControllerOpen = document.getElementById("hamburger");
		this.mobileNavControllerExit = document.getElementById("exitMobileMenu");
		this.mobileNavControllersLinks = document.getElementsByClassName("links");

		this.pageContent = document.getElementById("pageContent");

		this.mobileMenu = document.getElementById("menu");
	};

	openMenu()
	{
		this.mobileHeader[0].style.overflow = "visible";
		this.mobileMenu.style.top = "0";
		this.mobileMenu.style.opacity = "1";
		this.pageContent.classList.add("filterBody");
	};

	closeMenu()
	{
		this.mobileMenu.style.top = "-350%";
		this.mobileMenu.style.opacity = "0.9";
		this.pageContent.classList.remove("filterBody");

	};

	initControls()
	{
		this.mobileNavControllerOpen.addEventListener("click", (e) => 
		{
			e.preventDefault();
			this.openMenu();
		});

		this.mobileNavControllerExit.addEventListener("click", (e) => 
		{
			e.preventDefault();
			this.closeMenu();
		});

		for (let i = 0; i < this.mobileNavControllersLinks.length; i++)
		{
			this.mobileNavControllersLinks[i].addEventListener("click", () => 
				{
					this.closeMenu();
				});
		};
	};
};

let newMobileNav = new MobileNav;
newMobileNav.initControls();