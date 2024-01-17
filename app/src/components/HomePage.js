import papers from '../img/papers.jpg'; 

/**
 * HomePage Component
 * 
 * This component displays the information required for the homepage 
 * 
 * @author Elli Motazedi W19039439
 */
 
function HomePage() {
    return (
        <div className="d-flex flex-column align-items-center">
            <h1 className="my-5">KF6012 CIS Assessment 2022/23</h1>
            <img src={papers} className="Papers" width={500} height={400} alt="papers" />
            <i><p className="my-3">Photo by: Aaron Burden</p></i>
            <p className="my-3">This web application is part of Northumbria University coursework for the module: Web Application Integration (KF6012) </p>
        </div>
    );
}
 
export default HomePage;