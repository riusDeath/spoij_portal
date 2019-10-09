<?php 

class DatabaseQueue 
{
	protected $database;
	protected $job;
	protected $table;
	
	function __construct( $database)
	{
		// $this->job = $job;
		$this->table = "jobs";
		$this->database = $database;
	}

	public function pushToDatabase($data, $payload) {
		return $this->database->table($this->table)->insert($this->buildDatabaseRecord($data, $payload))->excute();
	}

	protected function buildDatabaseRecord($data, $payload) {
		return [
            'data' => $data,
            'created_at' => $this->currentTime(),
            'payload' => $payload,
        ];
	}

	public function popQueue() {

	}

	protected function deleteReserved() {
		return $this->database->customSQL("DELETE FROM $this->table LIMIT 1;")->excute();
	}

	protected function getDatabase() {
		return $this->database;
	}

	protected function currentTime()
    {
        return Carbon::now()->getTimestamp();
    }
}

?>