import { Form, FormControl } from 'react-bootstrap';

/**
 * Select component
 * 
 * This is a resuable select award component.
 * 
 * @author Elli Motazedi W19039439
 */
 
function SelectAward(props) {

	const onChangeSelect = (event) => props.handler(event.target.value);

	return (
		<div className="mb-3" style={{ width: '175px', left: '0' }}>
		  <Form.Group controlId="exampleForm.ControlSelect1">
			<Form.Control as="select" value={props.selectValue} onChange={onChangeSelect}>
			  <option value="all">All</option>
			  <option value="true">Award winners</option>
			  <option value="null">Non-award winners</option>
			</Form.Control>
		  </Form.Group>
		</div>
	);

}

export default SelectAward;
