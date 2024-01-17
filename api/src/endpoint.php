<?php
 
/**
 * A general class for endpoints
 * 
 * This class will be a parent for all endpoints (authors, papers, etc.) 
 * providing common methods. It has been declared as an abstract class
 * which means it is not possible to make an instance of this class itself.
 * 
 * @author Elli Motazedi W19039439
 */

abstract class Endpoint 
{
	private $data;
	private $sql;
	private $sqlParams;
	 
	/**
	 * Queries the database and saves the result 
	 */
	 
	public function __construct() {
		
		$db = new Database("db/chiplay.sqlite");
		$this->initialiseSQL();
		$data = $db->executeSQL($this->sql, $this->sqlParams);

		$this->setData( array(
			"length" => count($data),
			"message" => "Success",
			"data" => $data
		));

		$this->validateParams($this->endpointParams());
			
	}
	 
	protected function setSQL($sql) {
		$this->sql = $sql;
	}
	
	protected function getSQL() {
        return $this->sql;
    }
	 
	protected function setSQLParams($params) {
		$this->sqlParams = $params;
	}
	
	protected function getSQLParams() {
        return $this->sqlParams;
    }
	 
	protected function endpointParams() {
		return [];
	}
		 
	/**
	 * Checks the request parameters against an 
	 * array of valid endpoint parameters.
	 * 
	 * @param array $params An array of valid param names (e.g. ['id'])
	 */

	protected function validateParams($params) {
		foreach ($_GET as $key => $value) {
			if (!in_array($key, $params)) {
				http_response_code(400);
				$output['message'] = "Invalid parameter: " . $key;
				die(json_encode($output));
			}
		 }    
	}

	/**
	 * Defines the SQL and params 
	 * 
	 * As this is an abstract endpoint, the sql query is empty.
	 * Child classes, such as Papers, can ovveride this method 
	 * to set the SQL query needed for the specific endpoint. 
	 */
	 
	protected function initialiseSQL() {
		$sql = "";
		$this->setSQL($sql);
		$this->setSQLParams([]);
	}
	 
	protected function setData($data) {
		$this->data = $data;
	}
	 
	public function getData() {
		return $this->data;
	}
}

?>