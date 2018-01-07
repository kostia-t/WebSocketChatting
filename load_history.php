<?php 

require('vendor/autoload.php');

use ChatApp\Entities\Message;

echo Message::all()->toJson();
