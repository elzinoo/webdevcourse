<?php 
 
use FirebaseJWT\JWT;

/**
 * Authenticate endpoint
 *
 * This endpoint checks the username and password of the user.
 *
 * @author Elli Motazedi W19039439
 */
 
class Authenticate extends Endpoint
{
 
	/**
	* Queries the database and saves the result 
	*
	* Overrides the version in the parent. The query
	* selects specific items from author and 
	* affiliation tables. Returns success message.
	*/
	
    public function __construct() {
        $db = new Database("db/chiplay.sqlite");
        $this->validateRequestMethod("POST");
        $this->validateAuthParameters();
        $this->initialiseSQL();
        $queryResult = $db->executeSQL($this->getSQL(), $this->getSQLParams());
        $this->validateUsername($queryResult); 
        $this->validatePassword($queryResult);  
				
		$data['token'] = $this->createJWT($queryResult);

 
        $this->setData( array(
          "length" => 0, 
          "message" => "Success",
          "data" => $data
        ));
    }
	
	/**
	* Creates JSON Web Token
	*
	* Takes $queryResult as a parameter, which is used to
	* set the subject claim of the token. It also sets the issued
	* at claim to the current time and the expiration claim to
	* one day after the current time. The JWT is then encoded and
	* returned as the function's output.
	*/
	
	private function createJWT($queryResult) {
		$secretKey = SECRET;
		$time = time();
		
		$tokenPayload = [
			'iat' => $time,
			'exp' => strtotime('+1 day', $time),
			'iss' => $_SERVER['HTTP_HOST'],
			'sub' => $queryResult[0]['id']
		];
		
		$jwt = JWT::encode($tokenPayload, $secretKey, 'HS256');
		
		return $jwt;
	}
	
	/**
	* Sets the SQL needed for the authenticate endpoint
	*
	* Overrides the version in the parent. The query
	* selects the account ID, username and password. 
	*/
	
    protected function initialiseSQL() {
        $sql = "SELECT account_id, username, password FROM account WHERE username = :username";
        $this->setSQL($sql);
        $this->setSQLParams(['username'=>$_SERVER['PHP_AUTH_USER']]);
    }
 
	/**
	* Validates the request method
	* 
	* Compares the value of $method to the REQUEST_METHOD,
	* if they do not match, ClientErrorException is thrown.
	*/
	
    private function validateRequestMethod($method) {
        if ($_SERVER['REQUEST_METHOD'] != $method){
            throw new ClientErrorException("invalid request method", 405);
        }
    }

	/**
	* Validates the username and password 
	*
	* Checks if the username and password are set or not, 
	* if either are not set, ClientErrorException is thrown.
	*/ 
 
    private function validateAuthParameters() {
        if ( !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ) {
            throw new ClientErrorException("username and password required", 401);
        }
    }
 
	/**
	* Validates the username provided
	*
	* Checks whether the provided username is valid and 
	* exists in the database, if not ClientErrorException 
	* is thrown.
	*/
	
    private function validateUsername($data) {
        if (count($data)<1) {
            throw new ClientErrorException("invalid credentials", 401);
        } 
    }

	/**
	* Validates the password provided
	*
	* Checks whether the provided password is valid and 
	* exists in the database, if not ClientErrorException 
	* is thrown.
	*/
	
    private function validatePassword($data) {
        if (!password_verify($_SERVER['PHP_AUTH_PW'], $data[0]['password'])) {
            throw new ClientErrorException("invalid credentials", 401);
        } 
    }
}

?>