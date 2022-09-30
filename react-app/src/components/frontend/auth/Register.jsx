import React, {Component} from 'react';
import axios from 'axios';
import swal from 'sweetalert2';
import {Navigate} from 'react-router';
import {Link} from 'react-router-dom';

class Register extends Component {
    state = {
        name: "",
        email: "",
        password: "",
        confirm_password: "",
        permission: 3,
        active: 1,
        error_list: [],
        is_redirect_to_login: false,
        is_logged_in: false,
    }

    componentDidMount() {
        let flag = false;

        if (localStorage.length>0) {
            flag = (localStorage.getItem('user')!==undefined && localStorage.getItem('user')!=='');
        }

        this.setState({
            is_logged_in: flag,
        });
    }

    handleInput = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    handleRegister = async (e) => {
        e.preventDefault();

        this.setState({
            permission: 3,
            active: 1,
        });

        const res = await axios.post('http://localhost:8000/api/register', this.state);
        if (res.data.status === 200) {
            this.setState({
                name: "",
                email: "",
                password: "",
                confirm_password: "",
                permission: 0,
                active: 0,
                error_list: [],
                is_redirect_to_login: true,
            });

            swal.fire({
                title: 'Registered!',
                text: res.data.message,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        } else {
            this.setState({
                error_list: res.data.validation_error,
            });
        }
    }

    render()
    {
        let {is_redirect_to_login} = this.state;
        let {is_logged_in} = this.state;

        return(
            <div>
                {is_redirect_to_login && (<Navigate to="/login" />)}
                <div className="container mt-3">
                    <div className="row">
                        <div className="col-md-5">
                            <div className="card">
                                <div className="card-header">
                                    <h3>Register User</h3>
                                </div>
                                <div className="card-body">
                                    <form onSubmit={this.handleRegister}>
                                        <div className="form-group mb-3">
                                            <label>Full Name</label>
                                            <input type="text" name="name" onChange={this.handleInput} value={this.state.name} className="form-control" placeholder="Enter your full name" />
                                            <span className="text-danger">{this.state.error_list.name}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Email Address</label>
                                            <input type="text" name="email" onChange={this.handleInput} value={this.state.email} className="form-control" placeholder="Enter your email address" />
                                            <span className="text-danger">{this.state.error_list.email}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Password</label>
                                            <input type="password" name="password" onChange={this.handleInput} value={this.state.password} className="form-control" placeholder="Enter your password" />
                                            <span className="text-danger">{this.state.error_list.password}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Confirm Password</label>
                                            <input type="password" name="confirm_password" onChange={this.handleInput} value={this.state.confirm_password} className="form-control" placeholder="Enter your confirm password" />
                                            <span className="text-danger">{this.state.error_list.confirm_password}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Permission</label>
                                            <select name="permission" id="permission" value={this.state.permission} onChange={this.handleInput} className="form-control">
                                                <option value="4" default>Viewer</option>
                                                <option value="3">Editor</option>
                                                <option value="2">Admin</option>
                                                <option value="1">Super Admin</option>
                                            </select>
                                            <span className="text-danger">{this.state.error_list.permission}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Active</label>
                                            <select name="active" id="active" value={this.state.active} onChange={this.handleInput} style={{width:180}} className="form-select">
                                                <option value="1" default>Active</option>
                                                <option value="0">Inactive</option>                                                
                                            </select>
                                            <span className="text-danger">{this.state.error_list.active}</span>
                                        </div>
    
                                        <div className="form-group mb-3">
                                            <button type="submit" className="btn btn-primary">Register</button>
                                        </div>
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                    {!is_logged_in && (<p>Click Here for
                                        <Link to="/login">
                                            <span style={{marginLeft:"4px"}}>Login</span>
                                        </Link>
                                    </p>)}                    
                </div>
            </div>
        );
    }
}

export default Register;