<?php

echo "<h1> Name: Elli Motazedi | Student ID: W19039439 </h1><br>
	<h1> /api </h1><br>
	<p><b>URL:</b> http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api<br>
	<b>Description:</b> Returns an array of information, including: Student ID, Name, Link to documentation and Full conference name <br>
	<b>Methods supported:</b> N/A <br>
	<b>Authentication required:</b> False <br>
	<b>Parameters supported:</b> N/A <br>
	<b>Example response:</b> 0<br>
	{length: 3, message: 'Success', data: student: first_name: 'Elli', last_name: 'Motazedi', id: 'w19039439' <br>
	document: 'http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/documentation/documentation.php' <br>
	conference: name: 'CHI PLAY '21: The Annual Symposium on Computer-Human Interaction in Play'}<br><br>
	<h1> /api/papers </h1><br>
	<p><b>URL:</b> http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/papers <br>
	<b>Description:</b> Returns an array of information on papers <br>
	<b>Methods supported:</b> GET <br>
	<b>Authentication required:</b> False <br>
	<b>Parameters supported:</b><br>
	track (string, optional): Returns the paper with corresponding track <br>
	<b>Likely response codes:</b><br>
	200 ok (Paper details are returned) <br>
	204 no content (No paper exists with given track) <br>
	400 bad request (there is an invalid parameter or combination of parameters) <br>
	<b>Response keys:</b> length, message, data, paper_id, title, award, name (track), short_name (track) <br>
	<b>Example request:</b> http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/papers?track=wip <br>
	<b>Example response:</b> (200) <br>
	{'length':45,'message':'Success','data': <br>
	[{'Paper ID':'64774','Title':'A Study on Pok\u00e9mon GO: Exploring the Potential of Location-based MobileExergames in Connecting Players with Nature', <br>
	'Award status':null,'Abstract':'Exergaming incorporates exercising into video games, with the purpose of physically engaging users in the gameplay. <br>
	Location-based games have gained the attention of exergame designers as they have been able to motivate people to exercise and spend time in outdoors. <br>
	Studies have shown the impact of current exergames to intervene with sedentariness by containing some elements of nature and outdoor activities. <br>
	However, it is unclear how location-based mobile exergames can engage users with nature throughout playing and exercising. <br>
	This paper presents insights from an exploratory self-study of experiences provided by the most popular location-based mobile game, <br>
	Pok\u00e9mon GO, concerning its potential to engage players in outdoors. We also provide design considerations for location-based mobile exergames <br>
	to engage players in nature while becoming physically active.', <br>
	'Full Name of Track':'CHI PLAY 2021 Work-In-Progress','Short Name of Track':'wip'} <br><br>
	<h1> /api/authors </h1><br>
	<p><b>URL:</b> http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/authors <br>
	<b>Description:</b> Returns an array of information on authors <br>
	<b>Methods supported:</b> GET <br>
	<b>Authentication required:</b> False <br>
	<b>Parameters supported:</b><br>
	paper_id (int, optional): Returns the authors with corresponding Paper ID <br>
	<b>Likely response codes:</b><br>
	200 ok (Author details are returned) <br>
	204 no content (No author exists with given id) <br>
	400 bad request (there is an invalid parameter or combination of parameters) <br>
	<b>Response keys:</b> length, message, data, author_id, first_name, middle_initial, last_name, institution, country<br>
	<b>Example request:</b> http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/papers?paper_id=64460<br>
	<b>Example response:</b> (200) <br>
	{'length':4,'message':'Success','data':
	[{'AuthorID':'64306','FirstName':'Adela','MiddleInitial':null,'LastName':'Kapuscinska','Country':'United States','Institution':'Carnegie Mellon University'},
	{'AuthorID':'64245','FirstName':'Payal','MiddleInitial':'M','LastName':'Bhujwala','Country':'United States','Institution':'Human Computer Interaction Institute'},
	{'AuthorID':'64336','FirstName':'Melissa','MiddleInitial':null,'LastName':'Kalarchian','Country':'United States','Institution':'Duquesne University'},
	{'AuthorID':'64236','FirstName':'Jessica','MiddleInitial':null,'LastName':'Hammer','Country':'United States','Institution':'Carnegie Mellon University'}]} <br><br>
	<h1> /api/auth </h1><br>
	<p><b>URL:</b> http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/auth<br>
	<b>Description:</b> Once the user has logged in successfully, this endpoint returns a token (checks the username and password of the user) <br>
	<b>Methods supported:</b> POST <br>
	<b>Authentication required:</b> True <br>
	<b>Parameters supported:</b> 
	Username (string, mandatory): Specifies the user with which to log in to the system <br>
	Password (string, mandatory): Specifies the password of that user <br>
	<b>Likely response codes:</b><br>
	200 success (The correct username and password have been provided) <br>
	401 invalid credentials (the provided parameter(s) do not exist) <br>
	405 invalid request method (the requested method does not match the set method) <br>
	<b>Example response:</b> 0<br>
	{'length':0,'message':'Success','data':{'token': <br>
	'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NzQzMTgwMjUsImV4cCI6MTY3NDQwNDQyNSwiaXNzIjoidW5uLXcxOTAzOTQz
	OS5uZXdudW15c3BhY2UuY28udWsiLCJzdWIiOm51bGx9.epOBgwj9oYDh_e6wmoo3Xrr66hEhfj2ZRmxJyKVm7Ss'}}<br><br>
	<h1> /api/update </h1><br>
	<p><b>URL:</b> http://unn-w19039439.newnumyspace.co.uk/kf6012/coursework/api/update<br>
	<b>Description:</b> Updates the data and outputs a success message <br>
	<b>Methods supported:</b> POST <br>
	<b>Authentication required:</b> True <br>
	<b>Parameters supported:</b> 
	AwardSatus (string, mandatory): Sets the award status for the given PaperID <br>
	PaperID (int, mandatory): Specifies the PaperID for the award that needs updating <br>
	<b>Likely response codes:</b><br>
	200 success (The data has been successfully updated) <br>
	400 bad request (there is an invalid parameter or combination of parameters) <br>
	401 invalid token (the provided bearer token does not exist or is invalid) <br>
	405 invalid request method (the requested method does not match the set method) <br>
	<b>Example response:</b> 0<br>
	{'length':0,'message':'Success','data':null}<br>
	";
?>