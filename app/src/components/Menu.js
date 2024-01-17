import {LinkContainer} from 'react-router-bootstrap'
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';

/**
 * Main Menu Component 
 * 
 * This component displays the main navigation,
 * with links to all the main pages
 * 
 * @author Elli Motazedi W19039439
 */

function Menu() {
  return (
    <Navbar bg="dark" variant="dark">
      <Container>
        <LinkContainer to="/"><Navbar.Brand>KF6012 CIS</Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <LinkContainer to="/"><Nav.Link>Home</Nav.Link></LinkContainer>
			<LinkContainer to="/papers"><Nav.Link>Papers</Nav.Link></LinkContainer>
			<LinkContainer to="/admin"><Nav.Link>Admin</Nav.Link></LinkContainer>
            <NavDropdown title="Tracks" id="basic-nav-dropdown">
              <LinkContainer to="/interactivity"><NavDropdown.Item>Interactivity</NavDropdown.Item></LinkContainer>
              <LinkContainer to="/fullpapers"><NavDropdown.Item>FullPapers</NavDropdown.Item></LinkContainer>
			  <LinkContainer to="/wip"><NavDropdown.Item>WIP</NavDropdown.Item></LinkContainer>
              <LinkContainer to="/competition"><NavDropdown.Item>Competition</NavDropdown.Item></LinkContainer>
			  <LinkContainer to="/doctoral"><NavDropdown.Item>Doctoral</NavDropdown.Item></LinkContainer>
			  <LinkContainer to="/rapid"><NavDropdown.Item>Rapid</NavDropdown.Item></LinkContainer>
            </NavDropdown>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default  Menu;