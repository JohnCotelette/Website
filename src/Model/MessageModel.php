<?php 
namespace App\Src\Model;
use App\Src\Framework\Model;
use App\Src\Entity\Message;

class MessageModel extends Model
{
	private function buildObject($row)
	{
		$message = new Message();
		$message->setID($row["ID"]);
		$message->setDate($row["dateMessage"]);
		$message->setIdentity($row["identity"]);
		$message->setEmail($row["email"]);
		$message->setSubject($row["subject"]);
		$message->setContent($row["content"]);
		return $message;
	}

	public function addMessage($name, $email, $subject, $content)
	{
		$sql =
			"INSERT INTO messages (identity, email, subject, content)
			VALUES (?, ?, ?, ?)";
		$newMessage = $this->dataBase->createRequest($sql, [$name, $email, $subject, $content]); 
	}

	public function deleteMessage($messageID)
	{
		$sql = 
			"DELETE from messages
			WHERE ID = ?";
		$deleteMessage = $this->dataBase->createRequest($sql, [$messageID]);
	}

	public function getMessages()
	{
		$sql = 
			"SELECT ID, dateMessage, identity, email, subject, content
			FROM messages";
		$result = $this->dataBase->createRequest($sql);
		$messages = [];
		forEach($result as $row)
		{
			$messageID = $row["ID"];
			$messages[$messageID] = $this->buildObject($row);
		}
		$result->closeCursor();
		return $messages;
	}
}