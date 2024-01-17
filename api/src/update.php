<?php 

use FirebaseJWT\JWT;
use FirebaseJWT\Key;

/**
 * Update endpoint
 *
 * This endpoint updates the award status of the 
 * given paper_id.
 *
 * @author Elli Motazedi W19039439
 */

class Update extends Endpoint 
{
	
	/**
	* Queries the database and saves the result 
	*
	* Overrides the version in the parent. 
	*/
	
	public function __construct() 
	{
		$this->validateRequestMethod("POST");
		$this->validateToken();
		$this->validateUpdateParams();
		
		$db = new Database("db/chiplay.sqlite");
		
		$this->initialiseSQL();
		$queryResult = $db->executeSQL($this->getSQL(), $this->getSQLParams());
	 
		$this->setData( array(
		  "length" => 0,
		  "message" => "Success",
		  "data" => null
		));
	}
	
	/**
	* Validates the request method
	* 
	* Compares the value of $method to the REQUEST_METHOD,
	* if they do not match, ClientErrorException is thrown.
	*/
	
	private function validateRequestMethod($method) {
		if ($_SERVER['REQUEST_METHOD'] != $method) {
			throw new ClientErrorException("Invalid Request Method", 405);
		}
	}
	
	/*
	* Validates the token
	*
	* Retrieves the headers of the request, checks for the presence of 
	* the 'Authorization' header, verifies that the token is a Bearer token,
	* decodes the token using a key and checks that the issuer of the token 
	* matches the host of the current request. If the token is invalid,
	* an exception is thrown.
	*/
	
	private function validateToken() {
		
		$key = SECRET;
				
		$allHeaders = getallheaders();
		$authorizationHeader = "";
				
		if (array_key_exists('Authorization', $allHeaders)) {
			$authorizationHeader = $allHeaders['Authorization'];
		} elseif (array_key_exists('authorization', $allHeaders)) {
			$authorizationHeader = $allHeaders['authorization'];
		}

		if (substr($authorizationHeader, 0, 7) != 'Bearer ') {
			throw new ClientErrorException("Bearer token required", 401);
		}

		$jwt = trim(substr($authorizationHeader, 7));
		$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
		
		if ($decoded->iss != $_SERVER['HTTP_HOST']) {
			throw new ClientErrorException("invalid token issuer", 401);
		}
	}
	
	/*
	* Validates the parameters 
	*
	* Checks if the parameters are present in the POST request
	* and if the value of 'AwardStatus' is present in the award 
	* array, if it's not present, an exception is thrown. 
	*/
	
	private function validateUpdateParams() {

		if (!filter_has_var(INPUT_POST,'AwardStatus')) {
			throw new ClientErrorException("Award parameter required", 400);
		}   

		if (!filter_has_var(INPUT_POST,'PaperID')) {
			throw new ClientErrorException("Paper ID parameter required", 400);
		}   

		$award = ["true", "null"];

		if (!in_array(strtolower($_POST['AwardStatus']), $award)) {
			throw new ClientErrorException("invalid award status", 400);
		}

	}
	
	/**
	* Sets the SQL needed for the update endpoint
	*
	* Overrides the version in the parent. The query
	* updates the award based on the paper_id provided. 
	*/
	
	protected function initialiseSQL() {

		$award_ids = ["true"=>"true", "null"=>"null"];
		$input = $_POST['AwardStatus'];
		$award = $award_ids[$input];

		$sql = "UPDATE paper SET award = :award WHERE paper_id = :paper_id";
		$this->setSQL($sql);
		$this->setSQLParams(['award'=> $award, 'paper_id'=>$_POST['PaperID']]);

	}
	
}

?>