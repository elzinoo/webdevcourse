import { Routes, Route } from 'react-router-dom';
import React, { useState, useEffect } from 'react';
import HomePage from './components/HomePage';
import Interactivity from './components/Interactivity';
import FullPapers from './components/FullPapers';
import WIP from './components/WIP';
import Competition from './components/Competition';
import Doctoral from './components/Doctoral';
import Rapid from './components/Rapid';
import Papers from './components/Papers';
import AdminPage from './components/AdminPage';
import NotFound from './components/NotFound';
import Menu from './components/Menu';
import Footer from './components/Footer';
import './App.css';

function App() {
	
	const [authenticated, setAuthenticated] = useState(false);
	const [papers, setPapers] = useState([]);
	const [update,setUpdated] = useState(0);
	const [loading, setLoading] = useState(true);
	
	const handleAuthenticated = (isAuthenticated) => {setAuthenticated(handleAuthenticated)}
	
	useEffect( () => {
		fetch("http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/papers")
		.then(
			(response) => response.json()
		)
		.then(
			(json) => {
				setPapers(json.data)
				setLoading(false)
				console.log(json.data)
			}
		)
		.catch(
			(e) => {
				console.log(e.message)
			}
		)
    },[update]);
	
	const handleUpdate = () => {setUpdated(update+1)}
	
	return (
		<div className="App">
			<Menu />
			<Routes>
				<Route path="/" element={<HomePage />}/>
				<Route path="/interactivity" element={<Interactivity />}/>
				<Route path="/fullpapers" element={<FullPapers />}/>
				<Route path="/wip" element={<WIP />}/>
				<Route path="/competition" element={<Competition />}/>
				<Route path="/doctoral" element={<Doctoral />}/>
				<Route path="/rapid" element={<Rapid />}/>
				<Route path="/papers" element={<Papers />}/>
				<Route path="/admin" element={
					<AdminPage papers={papers} authenticated={authenticated} handleAuthenticated={setAuthenticated} handleUpdate={handleUpdate} />
				} />
				<Route path="*" element={<NotFound />}/> //Wild card ("*") that will match to anything not already matched and return the NotFound component. 
			</Routes>
			<Footer />
		</div>
	);
}
 
export default App;

