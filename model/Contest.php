<?php 

class Contest {
	public $fillable = ["title", 
						"description", 
						"input", 
						"output", 
						"status", 
						"category_id"];

	public $table = "contest";

}

?>
