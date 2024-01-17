<?php

/**
 * Base endpoint
 *
 * This endpoint shows information about the project, such as student details, 
 * documentation link and conference name
 *
 * @author Elli Motazedi W19039439
 */
 
 class Base extends Endpoint
 {
	/**
	* Overrides the constructor as 
	* querying the database is not
	* needed for this endpoint.
	*/
	
	public function __construct() {
		
		$db = new Database("db/chiplay.sqlite");
		$this->initialiseSQL();
		$conference = $db->executeSQL("SELECT name FROM conference_information");
		
		$student = array(
			"first_name" => "Elli",
			"last_name" => "Motazedi",
			"id" => "w19039439"
		);
		
		$data = array(
			"student" => $student,
			"document" => "http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/documentation/documentation.php",
		    "conference" => $conference
		);

		$this->setData( array(
			"length" => count($data),
			"message" => "Success",
			"data" => $data
		));
		
	}
 }
 
 ?>