<?php
 
class Response
{
	public function __construct() {
		header("Content-Type: application/json; charset=UTF-8");
		header("Access-Control-Allow-Origin: *"); 
	}
}

// very simple response class. This class might be extended with functionality for setting response codes.

?>