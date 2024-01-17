<?php

/**
 * Papers endpoint
 *
 * This endpoint returns information about the papers in JSON format
 * and supports the use of a 'track' parameter 
 *
 * @author Elli Motazedi W19039439
 */
 
 class Papers extends Endpoint
 {
	/**
	* Sets the SQL needed for the papers endpoint
	*
	* Overrides the version in the parent. The query
	* selects specific items from paper and 
	* track tables.
	*/
	
	protected function initialiseSQL() {
        $sql = "SELECT paper.paper_id AS 'PaperID', paper.title AS 'Title', ifnull(paper.award, 'null') AS 'AwardStatus', paper.abstract AS 'Abstract', 
		track.name AS 'FullNameOfTrack', track.short_name AS 'ShortNameOfTrack' FROM track INNER JOIN paper ON (track.track_id = paper.track_id)";
        $this->setSQL($sql);
        $params = array();
 
        if (filter_has_var(INPUT_GET, 'track')) {
			
			$track = htmlspecialchars($_GET['track']);
			
            if (isset($where)) {
                $where .= " AND track.short_name LIKE :track";
            } else {
                $where = " WHERE track.short_name LIKE :track";
            }
            $params['track'] = '%'.$track.'%';
        }
		
        if (isset($where)) {
            $sql .= $where;
        }

        $this->setSQL($sql);
        $this->setSQLParams($params);
    }
	
	/**
	* Overrides the version in the parent. 
	* Allows for 'track' parameter.
	*/
	
	protected function endpointParams() {
    return ['track'];
	}
	
 }
 
 ?>