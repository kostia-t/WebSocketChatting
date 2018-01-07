<?php 

namespace ChatApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use ChatApp\Entities\Message;

class Chat implements MessageComponentInterface 
{
	protected $clients;

	function __construct()
	{
		$this->clients = new \SplObjectStorage;
	}

	public function onOpen(ConnectionInterface $conn)
	{
		$this->clients->attach($conn);
		echo "New connection! ({$conn->resourceId})\n";
	}

	public function onMessage(ConnectionInterface $from, $msg)
	{
		// echo $msg;
		$msg = json_decode($msg);

		switch ($msg->type) {
			case 'message':
				foreach ($this->clients as $client) {
					if($client !== $from) {
						$client->send($msg->text);
					}
				}

				// insert the message into the database
				Message::create([
					'text' => $msg->text,
					'sender' => $msg->sender
				]);
			break;
			
			default:
				
			break;
		}

		// foreach ($this->clients as $client) {
		// 	if($client !== $from) {
		// 		$client->send($msg);
		// 	}
		// }

		// // insert the message into the database
		// Message::create([
		// 	'text' => $msg
		// ]);
	}

	public function onClose(ConnectionInterface $conn)
	{
		$this->clients->detach($conn);
		echo "Connection ({$conn->resourceId}) is disconnected \n";
	}

	public function onError(ConnectionInterface $conn, \Exception $e)
	{
		echo "An error has occured: {$e->getMessage()}";
		$conn->close();
	}
}