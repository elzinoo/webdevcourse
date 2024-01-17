/**
 * Search component
 * 
 * This is a resuable search component.
 * 
 * @author Elli Motazedi W19039439
 */

function Search(props) {
	
	const onChange = (event) => props.handler(event.target.value);
	
	return(
		<div className="col-sm-10">
			<input placeholder="Search" className="form-control" value={props.searchTerm} onChange={onChange} />
		</div>
	)
	
}

export default Search;