<?php 

class Job {
	public $fillable = [
						"userid",
						"storage", 
						"payload", 
						"contestid",
						'lanuage',
						"attempts", 
						"reserved_at", 
						"available_at", 
						"created_at"];

	public $table = "jobs";
}

?>