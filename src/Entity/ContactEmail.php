<?php
namespace App\Src\Entity;
use PHPMailer\PHPMailer\PHPMailer;

class ContactEmail
{
	private $email;

	public function __construct($data)
	{
		$this->email = new PHPmailer();
		$this->email->CharSet = CONTACT_EMAIL_ENCODE;
		$this->email->isSMTP();
		$this->email->SMTPAuth = CONTACT_EMAIL_SMTP_AUTH;
		$this->email->SMTPSecure = CONTACT_EMAIL_SMTP_SECURE;
		$this->email->SMTPDebug = CONTACT_EMAIL_DEBUG_STATUS;
		$this->email->Host = CONTACT_EMAIL_SMTP_HOSTADDRESS;
		$this->email->Port = CONTACT_EMAIL_SMTP_PORT;
		$this->email->Username = CONTACT_EMAIL_ADDRESS;
		$this->email->Password = CONTACT_EMAIL_PASSWORD;
		$this->email->setFrom(CONTACT_EMAIL_ORIGIN_ADDRESS, CONTACT_EMAIL_ORIGIN_NAME);
		$this->email->addAddress(CONTACT_EMAIL_RECIPIENT_ADDRESS, CONTACT_EMAIL_RECIPIENT_NAME);
		$this->email->isHTML(true);
		$this->email->Subject = $data["subject"];
		$this->email->Body = $this->addContent($data);
		$this->email->altBody = CONTACT_EMAIL_ALT_BODY ;
	}

	public function addContent($data)
	{
		extract($data);
		ob_start();
		require CONTACT_EMAIL_TEMPLATE;
		return ob_get_clean();
	}

	public function sendEmail()
	{
		$this->email->send();
	}
}