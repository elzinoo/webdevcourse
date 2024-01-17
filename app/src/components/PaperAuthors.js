import React, { useState, useEffect } from 'react';

/**
 * Paper Authors component
 * 
 * This component displays details of each author associated with 
 * the specified paper, by interacting with the web API. 
 * 
 * @author Elli Motazedi W19039439
 */

function PaperAuthors(props) {
	
    const [authors, setAuthors] = useState([]);
	const [loading, setLoading] = useState(true);
	const [showButton, setShowButton] = useState(true);
 
 
    const fetchAuthors = () => {
        fetch("http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/authors?paper_id="+props.paper_id)
        .then( 
            (response) => response.json()
        )
        .then( 
            (json) => {  
                setAuthors(json.data)
				setLoading(false)
            } 
        )
        .catch(
            (e) => {
                console.log(e.message)
            }
        )
    }
	
	const showAuthors = () => {
        setLoading(true);
        setShowButton(false);
        fetchAuthors();
    }
 
    const listOfAuthors = 
        authors.map(
            (value, key) =><p key={key}> <b>Author: </b>{value.FirstName} {value.MiddleInitial} {value.LastName}, {value.Country}, {value.Institution}</p>
        );
 
	return (
		<div className="container">
			<ul className="list-group">{listOfAuthors}</ul>
			{showButton && <button className="btn btn-secondary" onClick={showAuthors}>Show Authors</button>}
		</div>
	)
}
 
export default PaperAuthors;
