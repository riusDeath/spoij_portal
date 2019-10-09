<?php 

class Grade_combine {
	public $fillable = [
						"userid", 
						"contestid", 
						'grade',
						'time_combine',
						'language',
						'jobid'
					];

	public $table = "grade_combine";
}

?>