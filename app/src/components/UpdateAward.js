import React, { useState, useEffect } from 'react';
import PaperAuthors from './PaperAuthors';
import 'bootstrap/dist/css/bootstrap.min.css';

/**
 * Update Award Component
 * 
 * This component interacts with the API (Update endpoint) to 
 * update the award status of the selected paper, which also updates 
 * the database. Users can only access this component if they are 
 * logged in.
 * 
 * @author Elli Motazedi W19039439
 */

function UpdateAward(props) {
	
	const [showMore, setShowMore] = useState(false);
	
	const handleSelect = (event) => {
	  
		const formData = new FormData();
		formData.append('AwardStatus', event.target.value);
		formData.append('PaperID', props.papers.PaperID);
	 
		const token = localStorage.getItem('token'); 
	 
		fetch("http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/update",
		{
			method: 'POST',
			headers: new Headers( { "Authorization": "Bearer " + token}),
			body: formData
		})
		.then(
			(response) => response.text()
		)
		.then(
			(json) => {
				console.log(json)
				props.handleUpdate()
			}
		)
		.catch(
			(e) => {
				console.log(e.message)
			}
		)
	}
 
    return (
		<div>
			<div className="card text-black bg-light mb-3">
				<div className="card-header">
					<h3>{props.papers.Title}</h3>
				</div>
				<div className="card-body">
					<p className="card-text">
						<b>Abstract: </b>
						{showMore ? props.papers.Abstract : props.papers.Abstract.substring(0, 100)}
						{!showMore && <a onClick={() => setShowMore(!showMore)}>...<i>show more</i></a>}
						{showMore && <a onClick={() => setShowMore(!showMore)}><br /><i>show less</i></a>}
					</p>
					<div className="mb-3">
						<select className="form-control" value={props.papers.AwardStatus.toLowerCase()} onChange={handleSelect}>
							<option value="true">Award winner</option>
							<option value="null">Non-award winner</option>
						</select>
					</div>
					<div>
						<PaperAuthors paper_id={props.papers.PaperID} />
					</div>
				</div>
			</div>
		</div>
	)
	
}
export default UpdateAward;