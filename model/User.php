<?php 

class User {
	public $fillable = ['username', 
						'email', 
						'password', 
						'avatar', 
						'status', 
						'roleid'];

	public $table = "user";

}

?>
