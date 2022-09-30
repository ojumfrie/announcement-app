import React, {Component} from 'react';
import axios from 'axios';
import {Navigate} from 'react-router';
import {Link} from 'react-router-dom';
import swal from 'sweetalert2';

class Login extends Component {
    state = {
        email: "",
        password: "",
        error_list: [],
        is_logged_in: false,
    }

    componentDidMount() {
        if (localStorage.length>0) {
            this.setState({
                is_logged_in: ((localStorage.getItem('user')!==undefined)&&(localStorage.getItem('user')!=='')),
            });
        }
    }

    handleInput = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    handleLogin = async (e) => {
        e.preventDefault();

        const currentClickedElement = document.getElementById("login");
        currentClickedElement.innerText = "Logging in...";

        const res = await axios.post('http://localhost:8000/api/login', this.state);
        if (res.data.status === 200) {
            localStorage.setItem('user', res.data.user.name);
            currentClickedElement.innerText = "Login";
            this.setState({
                name: "",
                password: "",
                error_list: [],
                is_logged_in: true,
            });            
        } else if (res.data.status === 404) {
            currentClickedElement.innerText = "Login";
            swal.fire({
                title: 'Login Failed.',
                text: res.data.message,
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        } else {
            currentClickedElement.innerText = "Login";
            this.setState({
                error_list: res.data.validation_error,
            });
        }
    }

    render()
    {
        let {is_logged_in} = this.state;

        return(
            <div>
                {is_logged_in && (<Navigate to="/" />)}
                <div className="container mt-3">
                    <div className="row">
                        <div className="col-md-5">
                            <div className="card">
                                <div className="card-header">
                                    <h3>Login</h3>
                                </div>
                                <div className="card-body">
                                    <form onSubmit={this.handleLogin}>
                                        <div className="form-group mb-3">
                                            <label>Email</label>
                                            <input type="text" name="email" onChange={this.handleInput} value={this.state.email} className="form-control" placeholder="Enter your email" />
                                            <span className="text-danger">{this.state.error_list.email}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Password</label>
                                            <input type="password" name="password" onChange={this.handleInput} value={this.state.password} className="form-control" placeholder="Enter your password" />
                                            <span className="text-danger">{this.state.error_list.password}</span>
                                        </div>
    
                                        <div className="form-group mb-3">
                                            <button type="submit" id="login" className="btn btn-primary">Login</button>
                                        </div>
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                    {!is_logged_in && <p>Don't Have Account ?
                                        <Link to="/register">
                                            <span style={{marginLeft:"4px"}}>Register</span>
                                        </Link>
                                    </p>}
                    
                </div>
            </div>
        );
    }
}

export default Login;