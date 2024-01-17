import React, { useState, useEffect } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import PaperAuthors from './PaperAuthors';
import Search from './Search';
import SelectAward from './SelectAward';

/**
 * Rapid component
 * 
 * This component displays details of each paper associated with the 
 * rapid track, by interacting with the API. Users are 
 * able to search and filter the data through this page.
 * 
 * @author Elli Motazedi W19039439
 */
 
function Rapid() {
    const [papers, setTrack] = useState([]);
    const [loading, setLoading] = useState(true);
    const [searchTerm, setSearchTerm] = useState('');
    const [selectValue, setSelectValue] = useState('all');
    const [showMore, setShowMore] = useState(false);
 
    useEffect( () => {
      fetch("http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/papers")
        .then( 
          (response) => response.json() 
        )
        .then( 
          (json) => {
              setTrack(json.data);
              console.log(json.data)
              setLoading(false);
              } 
        )
        .catch((err) => {
          console.log(err.message);
        });
    }, []);
  
    const searchPapers = (value) => {
        const fulldetails = value.Title + " " + value.Abstract;
        return fulldetails.toLowerCase().includes(searchTerm.toLowerCase());
    }
    
    const selectPapers = (value) => ( 
        ((value.AwardStatus === "null") && (selectValue === "null"))
        || ((value.AwardStatus === "true") && (selectValue === "true"))
        || (selectValue === "all")
    );
 
    const track = (value) => (value.ShortNameOfTrack === "rapid");
    
    const showRapid = papers
        .filter(track)
        .filter(searchPapers)
        .filter(selectPapers)
        .map((value, key) => (
            <div className="card text-black bg-light mb-3" key={key}>
                <div className="card-header"><h3>{value.Title}</h3></div>
                <div className="card-body">
                    <p className="card-text"><b>Abstract: </b>{showMore ? value.Abstract : value.Abstract.substring(0, 100)}
                    {!showMore && <a onClick={() => setShowMore(!showMore)}>...<i>show more</i></a>}
                    {showMore && <a onClick={() => setShowMore(!showMore)}><br /><i>show less</i></a>}</p>
                    <p className="card-text"><b>Award Status: </b>{value.AwardStatus}</p>
                    <PaperAuthors paper_id={value.PaperID} />
                </div>
            </div>
        ))
	;
    
    const searchHandler = (event) => {
        setSearchTerm(event)
    }
    
    const handler = (event) => {
        setSelectValue(event)
    }
 
    return (
		<div className="container my-5">
			<div className="card text-black bg-light mb-3 d-flex flex-column align-items-center">
				<h1 className="my-3">Rapid</h1>
				<div className="row">
					<div className="col-md-6 d-flex justify-content-center">
						<Search searchTerm={searchTerm} handler={searchHandler} />
					</div>
					<div className="col-md-6 d-flex justify-content-center">
						<SelectAward selectValue={selectValue} handler={handler} />
					</div>
				</div>
			</div>
			{loading && <p>Loading...</p>}
			{showRapid}
	    </div>
	)

}
 
export default Rapid;