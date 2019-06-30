<?php 
const HOST = "localhost";
const DB_NAME = "samuel";
const CHARSET = "utf8";
const DB_USER = "root";
const DB_PASSWORD = "";
const DB_HOST = "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=" . CHARSET;

const CONTACT_EMAIL_ENCODE = "UTF-8";
const CONTACT_EMAIL_DEBUG_STATUS = 0;
const CONTACT_EMAIL_SMTP_AUTH = true;
const CONTACT_EMAIL_SMTP_HOSTADDRESS = "smtp.gmail.com";
const CONTACT_EMAIL_SMTP_PORT = 465;
const CONTACT_EMAIL_SMTP_SECURE = "ssl";
const CONTACT_EMAIL_ADDRESS = "";
const CONTACT_EMAIL_PASSWORD = "";
const CONTACT_EMAIL_ORIGIN_ADDRESS = "";
const CONTACT_EMAIL_ORIGIN_NAME = "Formulaire de contact du site personnel";
const CONTACT_EMAIL_RECIPIENT_ADDRESS = "";
const CONTACT_EMAIL_RECIPIENT_NAME = "Samuel";
const CONTACT_EMAIL_ALT_BODY = "Vous avez reçu un nouveau message consultable dans votre espace admin de samueldarras.com";
const CONTACT_EMAIL_TEMPLATE = "../template/ContactMailContent.php";