import React, {useState} from 'react';
import {Link} from 'react-router-dom';
import swal from 'sweetalert2';

function NavBar() {
    let flag = false;

    if (localStorage.length>0) {
        flag = (localStorage.getItem('user')!==undefined && localStorage.getItem('user')!=='');
    }

    const [isLoggedIn, setIsLoggedIn] = useState(flag);

    const handleLogout = (e) => {
        e.preventDefault();

        localStorage.removeItem('user');
        setIsLoggedIn(false);

        swal.fire({
            title: 'Logged out!',
            text: 'You have successfully logged out.',
            icon: 'info',
            confirmButtonText: 'OK',
        });

        window.location.replace("/");
    };

    return(
        <nav className="navbar navbar-expand-lg navbar-light bg-primary shadow sticky-top mb-4">
            <div className="container-fluid">
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className="collapse navbar-collapse" id="navbarSupportedContent">                
                    <ul className="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <Link className="nav-link active" to="/">Home</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/users">Users</Link>
                        </li>
                        <li className="nav-item">
                            {!isLoggedIn && (<Link className="nav-link" to="/login">Login</Link>)}
                        </li>
                        <li className="nav-item">
                            {!isLoggedIn && (<Link className="nav-link" to="/register">Register</Link>)}
                        </li>
                        <li className="nav-item" style={{cursor:'pointer'}}>
                            {isLoggedIn && (<a className="nav-link" onClick={handleLogout}>Logout</a>)}
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}

export default NavBar;