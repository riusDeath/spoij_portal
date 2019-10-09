<?php
class DatabaseQueue extends queue
{
    protected $database;

    protected $table;

    protected $default;

    protected $retryAfter = 60;

    protected $job;

    public function __construct($database, $table, $default = 'default', $retryAfter = 60)
    {
        $this->table = $table;
        $this->default = $default;
        $this->database = $database;
        $this->retryAfter = $retryAfter;
    }

    public function size($queue = null)
    {
        return $this->database->table($this->table)
                    ->where(['queue' => $this->getQueue($queue)])
                    ->excuteSelect()
                    ->count();
    }

    /**
     * Push a new job onto the queue.
     */
    public function push($job, $data = '', $queue = null)
    {
        return $this->pushToDatabase($queue, $this->createPayload(
            $job, $this->getQueue($queue), $data
        ));
    }

    /**
     * Push a raw payload to the database with a given delay.
     */
    protected function pushToDatabase($queue, $payload, $delay = 0, $attempts = 0)
    {
        return $this->database->table($this->table)->insert($this->buildDatabaseRecord(
            $this->getQueue($queue), $payload, $this->availableAt($delay), $attempts
        ))->excute();
    }

    /**
     * Create an array to insert for the given job.
     */
    protected function buildDatabaseRecord($queue, $payload, $availableAt, $attempts = 0)
    {
        return [
            'queue' => $queue,
            'attempts' => $attempts,
            'reserved_at' => null,
            'available_at' => $availableAt,
            'created_at' => $this->currentTime(),
            'payload' => $payload,
        ];
    }

    /**
     * Pop the next job off of the queue.
     */
    public function pop($queue = null)
    {
        $queue = $this->getQueue($queue);

    }

    public function getNextAvailableJob($queue) {
    	$queue = $this->getQueue($queue);

    	// return $this->database->
    }

    /**
     * Delete a reserved job from the queue.
     */
    public function deleteReserved($queue, $id)
    {
        return $this->database->table($this->table)->delete($id)->excute();
    }

    /**
     * Get the queue or return the default.
     */
    public function getQueue($queue)
    {
        return $queue ?: $this->default;
    }

    /**
     * Get the underlying database instance.
     */
    public function getDatabase()
    {
        return $this->database;
    }
}
