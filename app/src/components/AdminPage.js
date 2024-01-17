import React, {useState, useEffect} from 'react';
import { Buffer } from 'buffer';
import 'bootstrap/dist/css/bootstrap.min.css';
import UpdateAward from './UpdateAward';
import Search from './Search';
import SelectAward from './SelectAward';

/**
 * Admin Page Component
 * 
 * This component interacts with the API (Authorization endpoint) to check 
 * if the username and password have been successfully authenticated. 
 * It allows the user to sign in and sign out of the web application.
 * If the user is signed in, it shows the UpdateAward component. Users
 * can search through the titles and abstracts, select award status,
 * and limit the amount of papers shown on the page. 
 * 
 * @author Elli Motazedi W19039439
 */

function AdminPage(props) {
 
    const [username, setUsername] = useState("");
    const [password, setPassword] = useState("");
	const [loading, setLoading] = useState(false);
    const [limit, setLimit] = useState(10);
	const [resultsPerPage, setResultsPerPage] = useState(10);
	const [searchTerm, setSearchTerm] = useState('');
    const [selectValue, setSelectValue] = useState('all');
	
	useEffect(
        () => {
            if (localStorage.getItem('token')) {
                props.handleAuthenticated(true)
            }
        }
    ,[])
	 
    const handleUsername = (event) => {
        setUsername(event.target.value);
    }
 
    const handlePassword = (event) => {
        setPassword(event.target.value);
    }
	
	const handleSubmit = () => {
 
        const encodedString = Buffer.from(
            username + ":" + password
          ).toString('base64');
 
        fetch("http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/auth",
        {
            method: 'POST',
            headers: new Headers( { "Authorization": "Basic " +encodedString })
        })
        .then(
            (response) => {   
                return response.json()
            }
        )
        .then(
            (json) => {
				console.log(json);
                 if (json.message === "Success") {
					props.handleAuthenticated(true);
					localStorage.setItem('token', json.data.token);
				}
            }
        )
        .catch(
            (e) => {
                console.log(e.message)
            }
        )
    }
	
	const handleSignOut = () => {
		props.handleAuthenticated(false);
		setPassword("");
		setUsername("");
		localStorage.removeItem('token');
	}
	
	const searchPapers = (value) => {
        const fulldetails = value.Title + " " + value.Abstract;
        return fulldetails.toLowerCase().includes(searchTerm.toLowerCase());
    }
    
    const selectPapers = (value) => ( 
        ((value.AwardStatus === "null") && (selectValue === "null"))
        || ((value.AwardStatus === "true") && (selectValue === "true"))
        || (selectValue === "all")
    );
	
	const allPapers = props.papers
		.slice(0,limit)
		.filter(searchPapers)
        .filter(selectPapers)
		.map(
		(value, key) => <section key={key}>
			<UpdateAward papers={value} handleUpdate = {props.handleUpdate} />
		</section>
	)
	
	const handleResultsPerPage = (event) => {
		setResultsPerPage(event.target.value);
		setLimit(event.target.value);
	}
	
	const searchHandler = (event) => {
        setSearchTerm(event)
    }
    
    const handler = (event) => {
        setSelectValue(event)
    }
	
	const loadMore = () => { setLimit(limit+10) }
	const resultsPerPageOptions = [10, 25, 50, 100];
	
	const resultsPerPageSelect = (
		<div className="form-group">
			<select className="form-control" value={resultsPerPage} onChange={handleResultsPerPage}>
				{resultsPerPageOptions.map((option) => (
					<option key={option} value={option}>
						{option}
					</option>
				))}
			</select>
		</div>
	);
 
	return (
	    <div>
			{props.authenticated && (
			    <div className="container my-5">
					<div className="card text-black bg-light mb-3 d-flex flex-column align-items-center">
						<h1 className="my-3">Admin</h1>
						<div className="row">
							<div className="col-md-4 d-flex justify-content-center">
								<Search searchTerm={searchTerm} handler={searchHandler} />
							</div>
							<div className="col-md-3 d-flex justify-content-center">
								<SelectAward selectValue={selectValue} handler={handler} />
							</div>
							<div className="col-md-3 d-flex justify-content-center">
								<label>Results per page:</label>
							</div>
							<div className="col-md-2 d-flex justify-content-center">
								{resultsPerPageSelect}
							</div>
						</div>
						<div className="col-md-6 d-flex justify-content-center">
							<button className="btn btn-danger my-3" onClick={handleSignOut}>Sign out</button>
						</div>
					</div>
					<div className="row">
						{loading && <p>Loading...</p>}
						{allPapers}
						{!loading && <button className="btn btn-dark mb-3" onClick={loadMore}>Load More</button>}
					</div>

			    </div>
			)}
			{!props.authenticated && (
			    <div className="container my-5">
					<h1 className="text-center">Sign in</h1>
					<div className="form-group my-3">
					    <input
							className="form-control"
							type="text"
							placeholder="username"
							value={username}
							onChange={handleUsername}
					    />
					</div>
					<div className="form-group my-3">
					    <input
							className="form-control"
							type="password"
							placeholder="password"
							value={password}
							onChange={handlePassword}
					    />
					</div>
					<div className="form-group text-center my-3">
					    <button className="btn btn-primary" onClick={handleSubmit}>Sign In</button>
					</div>
			    </div>
			)}
	    </div>
	);

}
export default AdminPage;