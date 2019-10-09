<?php 

class Job {
	public $fillable = ["connection", 
						"queue", 
						"payload", 
						"exception", 
						"failed_at"] ;

	public $table = "failed_jobs";

}

?>