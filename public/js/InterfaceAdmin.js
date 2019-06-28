class InterfaceAdmin
{
	constructor()
	{
		this.totalPageContent = document.getElementById("totalPageContent");
		this.links = document.querySelectorAll(".adminLinks");
		this.controllers = document.getElementsByClassName("sectionTitles");
		this.smallControllers = document.getElementsByClassName("smallCategories");
		this.contents = document.getElementsByClassName("containers");
		this.smallContents = document.getElementsByClassName("smallContents");
		this.bigArrows = document.getElementsByClassName("bigArrows");
		this.smallArrows = document.getElementsByClassName("smallArrows");
		this.buttons = document.getElementsByClassName("buttons");

		this.totalMessagesContainer = document.getElementById("totalMessagesContainer");
		this.messagesContainers = document.getElementsByClassName("messagesContainers");
		this.deleteMessageButtons = document.getElementsByClassName("deleteMessageButtons");
		this.messagesSeparators = document.getElementsByClassName("messagesHr");
		this.messagesDeleted = 0;

		this.formCustomSiteTextContent = document.getElementById("textCustomForm");
		this.formCustomSiteSkills = document.getElementById("skillsCustomForm");
		this.formCustomSiteProjects = document.getElementById("projectsForm");
		this.mod = 0;
		this.modIndicator = document.getElementById("modType");
		this.modResetButton = document.getElementById("changeMod");
		this.modIndicatorTarget = document.getElementById("modIndicatorTarget");
		this.lastImageBlock = document.getElementById("lastPictureName");
		this.projectPictureNameLabel = document.getElementById("projectPictureNameLabel");
		this.projectsAddSubmitButton = document.getElementById("submitProjectsAddForm");
		this.projectDeleteButtons = document.getElementsByClassName("deleteProjectButtons");
		this.projectEditButtons = document.getElementsByClassName("editProjectButtons");
		this.projectsContainers = document.getElementsByClassName("projectsContainers");

		this.formAddAdmin = document.getElementById("addAdmin");
		this.adminButtonsDelete = document.getElementsByClassName("adminButtonsDelete");
		this.adminsContainers = document.getElementsByClassName("adminsList");
		this.adminsSeparators = document.getElementsByClassName("adminsHr");

		this.formChangeTheme = document.getElementById("themesForm");
		this.formChangeThemeButtonChange = document.getElementById("submitTheme");
		this.oldTheme = document.querySelector('input[name=themeChoices]:checked');
		this.oldThemeName = this.oldTheme.value;
		this.oldThemeID = this.oldTheme.getAttribute("data-themeID");

		this.response;
		this.ajax = new Ajax;
	};

	deleteMessage(messageID, i)
	{
		let confirm = window.confirm("Ce message sera définitivement supprimé de la base de données, continuer ?");
		if (confirm)
		{
			let data = "deleteMessage=true" + "&messageID=" + messageID + "&jsAuthorization=true";
			this.ajax.sendData("index.php", data, (response) => 
			{
				alert(response);
				if (response === "Le message a bien été supprimé de la base de données.")
				{
					this.displayMessageDeleted(i);
				}
				else
				{
					return;
				};
			});
		}
		else
		{
			return;
		};
	};

	editSiteTextContent()
	{
		let confirm = window.confirm("Confirmer les modifications ?");
		if (confirm)
		{
			let formData = new FormData(this.formCustomSiteTextContent);
			formData.append("jsAuthorization", true);
			this.ajax.sendData("index.php", formData, (response) =>
			{
				alert(response);
			}, "formData");
		}
		else
		{
			return;
		}
	};

	editSiteSkills()
	{
		let confirm = window.confirm("Confirmer les modifications ?");
		if (confirm)
		{
			let formData = new FormData(this.formCustomSiteSkills);
			formData.append("jsAuthorization", true);
			formData.append("editSkills", true);
			this.ajax.sendData("index.php", formData, (response) =>
			{
				alert(response);
			}, "formData");
		}
		else
		{
			return;
		}
	};

	addProject()
	{
		let confirm = window.confirm("Confirmer l'ajout du projet ?");
		if (confirm)
		{
			let formData = new FormData(this.formCustomSiteProjects);
			formData.append("jsAuthorization", true);
			formData.append("addProject", true);
			this.ajax.sendData("index.php", formData, (response) => 
			{
				alert(response);
				if (response === "L'article a bien été ajouté.")
				{
					this.displayConfirmAlert();
				}
				else
				{
					return;
				};
			}, "formData");
		}
		else
		{
			return;
		};
	};

	getDataProject(projectID)
	{
		let data = "requestDataProject=true" + "&projectID=" + projectID + "&jsAuthorization=true";
		this.ajax.sendData("index.php", data, (response) => 
		{
			this.formCustomSiteProjects.projectTitle.value = response["title"];
			this.formCustomSiteProjects.projectType.value = response["type"];
			this.formCustomSiteProjects.projectLink.value = response["link"];
			this.formCustomSiteProjects.projectGithubLink.value = response["githubLink"];
			this.formCustomSiteProjects.projectDesc.value = response["description"];
			this.formCustomSiteProjects.setAttribute("data-projectID", response["ID"]);
			this.formCustomSiteProjects.setAttribute("data-lastPicture", response["pictureName"]);
		}, "json");
	};

	editProject()
	{
		let confirm = window.confirm("Confirmer la modification du projet ?");
		if (confirm)
		{
			let formData = new FormData(this.formCustomSiteProjects);
			formData.append("editProject", true);
			formData.append("jsAuthorization", true);
			formData.append("projectID", this.formCustomSiteProjects.getAttribute("data-projectID"));
			formData.append("lastPicture", this.formCustomSiteProjects.getAttribute("data-lastPicture"));
			this.ajax.sendData("index.php", formData, (response) =>
			{
				alert(response);
				if (response === "Le projet a bien été modifié.")
				{
					this.mod = 0;
					alert("La page va être rechargée.")
					window.location.reload();
				}
				else
				{
					return;
				}
			}, "formData");
		}
		else
		{
			return;
		}
	};

	deleteProject(projectID, i)
	{
		let confirm = window.confirm("Confirmer la suppression du projet ?");
		if (confirm)
		{
			let data = "deleteProject=true" + "&projectID=" + projectID + "&jsAuthorization=true";
			this.ajax.sendData("index.php", data, (response) => 
			{
				alert(response);
				if (response === "Le projet séléctionné a bien été supprimé de la base de données.")
				{
					this.displayConfirmProjectDeleted(i);
				}
				else
				{
					return;
				};
			});
		}
		else
		{
			return;
		};
	};

	addAdmin()
	{
		let confirm = window.confirm("Voulez vous insérer dans la base de données un nouveau collaborateur ?\nPseudo: " + this.formAddAdmin.addAdminPseudo.value + "\nMot de passe: " + this.formAddAdmin.addAdminPassword.value + "\nStatut: " + this.formAddAdmin.addAdminRights.value);
		if (confirm)
		{
			let formData = new FormData(this.formAddAdmin);
			formData.append("jsAuthorization", true);
			this.ajax.sendData("index.php", formData, (response) =>
			{
				alert(response);
				if (response === "Le nouveau collaborateur a bien été ajouté à la base de données.")
				{
					this.displayConfirmAlert();
				}
				else
				{
					return;
				};
			}, "formData");
		}
		else
		{
			return;
		};
	};

	deleteAdmin(adminID, i)
	{
		let confirm = window.confirm("Cet admin sera supprimé de la base de données.\nCette action est irréversible.");
		if (confirm)
		{
			let data = "deleteAdmin=true" + "&adminID=" + adminID + "&jsAuthorization=true";
			this.ajax.sendData("index.php", data, (response) => 
			{
				alert(response);
				if (response === "L'admin séléctionné a bien été supprimé de la base de données.")
				{
					this.displayConfirmAdminDeleted(i);
				}
				else
				{
					return;
				};
			});
		}
		else
		{
			return;
		}
	};

	changeTheme()
	{
		let newThemeName = document.querySelector('input[name=themeChoices]:checked').value;
		if (this.oldThemeName == newThemeName)
		{
			alert("Le thème que vous avez sélectionné correspond déjà à celui que vous utilisez.")
			return;
		}
		else
		{
			let newTheme = document.querySelector('input[name=themeChoices]:checked');
			let newThemeID = newTheme.getAttribute("data-themeID");
			let data = "changeTheme=true" + "&oldThemeID=" + this.oldThemeID + "&newThemeID=" + newThemeID  + "&jsAuthorization=true";
			this.ajax.sendData("index.php", data, (response) => 
			{
				this.displayChangeTheme(response);
			}, "json");
			this.oldTheme = newTheme;
			this.oldThemeName = newThemeName;
			this.oldThemeID = newThemeID;
			return;
		};
	};

	changeForm()
	{
		if (this.mod == 1)
		{
			this.modIndicator.textContent = "Mode édition";
			this.projectsAddSubmitButton.value = "Editer";
			this.formCustomSiteProjects.projectPicture.required = false;
			this.modResetButton.style.display = "inline-block";
			this.lastImageBlock.textContent = "Sans nouvelle image, l'ancienne sera conservée.";
			this.lastImageBlock.classList.remove("invisible");
			this.projectPictureNameLabel.textContent = "Image";
			this.scroll(this.modIndicatorTarget);
		}
		else
		{
			this.formCustomSiteProjects.reset();
			this.formCustomSiteProjects.removeAttribute("data-projectID");
			this.formCustomSiteProjects.removeAttribute("data-lastPicture");
			this.modIndicator.textContent = "Mode Ajout";
			this.projectsAddSubmitButton.value = "Ajouter";
			this.formCustomSiteProjects.projectPicture.required = true;
			this.modResetButton.style.display = "none";
			this.lastImageBlock.textContent = "";
			this.lastImageBlock.classList.add("invisible");
			this.projectPictureNameLabel.textContent = "Image*";
			this.scroll(this.modIndicatorTarget);
		};
	};

	scroll(target)
	{
		target.scrollIntoView(target);
	};

	displayConfirmAlert()
	{
		let confirmAlert = window.confirm("Actualiser la page pour prendre en compte les changements ?");
		if (confirmAlert)
		{
			location.reload();
		}
		else
		{
			return;
		};
	};

	displayMessageDeleted(i)
	{
		this.messagesContainers[i].style.display = "none";
		this.messagesDeleted++;
		if (this.messagesDeleted == this.messagesContainers.length)
		{
			this.totalMessagesContainer.style.paddingLeft = "0";
			this.totalMessagesContainer.style.textAlign = "center";
			this.totalMessagesContainer.textContent = "Vous avez supprimé l'intégralité de vos messages.";
		};
	};

	displayConfirmProjectDeleted(i)
	{
		this.projectsContainers[i].style.display = "none";
	};

	displayConfirmAdminDeleted(i)
	{
		this.adminsContainers[i + 1].style.display = "none";
		this.adminsSeparators[i + 1].classList.add("invisible");
	};

	displayChangeTheme(data)
	{
		this.totalPageContent.style.backgroundColor = data["backgroundColor"];
		for (let i = 0; i < this.controllers.length; i++)
		{
			this.controllers[i].style.backgroundColor = data["backgroundColorSections"];
			this.controllers[i].style.color = data["textColor"];
		};
		for (let i = 0; i < this.smallContents.length; i++)
		{
			this.smallContents[i].style.backgroundColor = data["backgroundColorContent"];
			this.smallContents[i].style.color = data["textColor"];
		};
		for (let i = 0; i < this.contents.length; i++)
		{
			this.contents[i].style.backgroundColor = data["backgroundColorContent"];
			this.contents[i].style.color = data["textColor"];
		};
		for (let i = 0; i < this.buttons.length; i++)
		{
			this.buttons[i].style.backgroundColor = data["backgroundColorButtons"];
		};
	};

	displayCategories(category)
	{
		this.contents[category].classList.toggle("scale");
		this.bigArrows[category].classList.toggle("fa-sort-up");
		this.bigArrows[category].classList.toggle("fa-sort-down");
	};

	displaySmallCategories(smallCategory)
	{
		this.smallContents[smallCategory].classList.toggle("invisible");
		setTimeout(() =>
		{
			this.smallContents[smallCategory].classList.toggle("scale");
			this.smallArrows[smallCategory].classList.toggle("fa-sort-up");
			this.smallArrows[smallCategory].classList.toggle("fa-sort-down");
		}, 15);
	};

	initControls()
	{
		this.links.forEach(link => 
		{
			link.addEventListener("click", (e) => {e.preventDefault();});
		});

		for (let i = 0; i < this.controllers.length; i++)
		{
			this.controllers[i].addEventListener("click", (e) => 
			{
				this.displayCategories(i);
			});
		};

		for (let i = 0; i < this.smallControllers.length; i++)
		{
			this.smallControllers[i].addEventListener("click", (e) => 
			{
				this.displaySmallCategories(i); 
			});
		};

		if (this.deleteMessageButtons)
		{
			for (let i = 0; i < this.deleteMessageButtons.length; i++)
			{
				this.deleteMessageButtons[i].addEventListener("click", () =>
				{
					this.deleteMessage(this.deleteMessageButtons[i].getAttribute("data-messageID"), i);
				});
			};
		};

		if (this.formCustomSiteTextContent)
		{
			this.formCustomSiteTextContent.addEventListener("submit", (e) =>
			{
				e.preventDefault();
				this.editSiteTextContent();
			});
		};

		if (this.formCustomSiteSkills)
		{
			this.formCustomSiteSkills.addEventListener("submit", (e) =>
			{
				e.preventDefault();
				this.editSiteSkills();
			});
		};

		if (this.formCustomSiteProjects)
		{
			this.formCustomSiteProjects.addEventListener("submit", (e) =>
			{
				e.preventDefault();
				if (this.mod == 0)
				{
					this.addProject();
				}
				else
				{
					this.editProject();
				}
			});

			for (let i = 0; i < this.projectDeleteButtons.length; i++)
			{
				this.projectDeleteButtons[i].addEventListener("click", (e) =>
				{
					this.deleteProject(this.projectDeleteButtons[i].getAttribute("data-projectID"), i);
				});
			};

			for (let i = 0; i < this.projectEditButtons.length; i++)
			{
				this.projectEditButtons[i].addEventListener("click", (e) =>
				{
					e.preventDefault();
					this.mod = 1;
					this.changeForm();
					this.getDataProject(this.projectEditButtons[i].getAttribute("data-projectID"));
				});
			};

			this.modResetButton.addEventListener("click", (e) =>
			{
				this.mod = 0;
				this.changeForm();
			});
		};

		if (this.formAddAdmin)
		{
			this.formAddAdmin.addEventListener("submit", (e) =>
			{
				e.preventDefault();
				this.addAdmin();
			});

			for (let i = 0; i < this.adminButtonsDelete.length; i++)
			{
				this.adminButtonsDelete[i].addEventListener("click", () =>
				{
					this.deleteAdmin(this.adminButtonsDelete[i].getAttribute("data-adminID"), i);
				});
			};
		};

		this.formChangeThemeButtonChange.addEventListener("click", (e) =>
		{
			e.preventDefault();
			this.changeTheme();
		});
	};
};

let newInterfaceAdmin = new InterfaceAdmin;
newInterfaceAdmin.initControls();