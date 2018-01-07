<?php 

namespace ChatApp\Entities;

class Message extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'message';	
	protected $fillable = ['text', 'sender'];
}