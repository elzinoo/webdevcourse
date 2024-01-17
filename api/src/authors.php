<?php

/**
 * Authors endpoint
 *
 * This endpoint returns information about the authors in JSON format 
 * and supports the use of a 'paper_id' parameter 
 *
 * @author Elli Motazedi W19039439
 */
 
 class Authors extends Endpoint
 {
	/**
	* Sets the SQL needed for the authors endpoint
	*
	* Overrides the version in the parent. The query
	* selects specific items from author and 
	* affiliation tables.
	*/
	
	protected function initialiseSQL() {
		 
		$sql = "SELECT author.author_id AS 'AuthorID', author.first_name AS 'FirstName', 
		author.middle_initial AS 'MiddleInitial', author.last_name AS 'LastName',
		affiliation.country AS 'Country', affiliation.institution AS 'Institution'
		FROM affiliation 
		JOIN author ON (affiliation.author_id = author.author_id)";
		
        $this->setSQL($sql);
        $params = array();
		
		if (filter_has_var(INPUT_GET, 'paper_id')) {
			
			if (!filter_var($_GET['paper_id'],FILTER_VALIDATE_INT)) {
				http_response_code(400);
				$output['message'] = "Value of id must be an integer";
				die(json_encode($output));
			} 
			if (isset($where)) {
				$where .= " AND paper_id = :paper_id";
			} else {
				$where = " WHERE paper_id = :paper_id";
			}
			$params['paper_id'] = $_GET['paper_id'];
		} 
		
		if (isset($where)) {
            $sql .= $where;
        }
		
		$this->setSQL($sql);
		$this->setSQLParams($params);
	}
	
	/**
	* Overrides the version in the parent. 
	* Allows for 'paper_id' parameter.
	*/
	
	protected function endpointParams() {
		return ['paper_id'];
	} 
 }

 ?>