<?php
class sqlConnection
{

	public $connection;
	public $result;
	public $lastid;
	private $row = array();
	private $rows = array();
	private $db;

	public function __construct()
	{
		$this->connectToDb();
	}
	public function __destruct()
	{
		mysqli_close($this->connection);
	}


	private function connectToDb()
	{
		$this->connection = new mysqli('localhost', 'root', '', 'barefoot_db');
		mysqli_set_charset($this->connection, 'utf8');
		if (mysqli_connect_error()) {
			return "can not connect to database " . mysqli_connect_error();
		}
	}


	public function query($query)
	{

		$data = new stdClass();

		$data->result = $this->connection->query($query);

		if (stristr($query, 'select')) {

			$this->rows = array();

			if ($data->result) {

				//$count = 0;
				if ($data->result->num_rows > 0) {

					while ($rowData = $data->result->fetch_assoc()) {
						//$count++;
						$this->rows[] = $rowData;
					}

					$this->row = $this->rows[0];
				}
			}

			$data->num_rows = $data->result->num_rows;
			$data->row = $this->row;
			$data->rows = $this->rows;
		} else {

			if (stristr($query, 'insert')) {
				$this->lastid = $this->connection->insert_id;
				$data->last_id = ($this->lastid) ? $this->lastid : null;
			}
		}

		return $data;
	}

	public function getRequest($data){
		return mysqli_real_escape_string($this->connection,$data);
	}
}
