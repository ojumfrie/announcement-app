import React, {Component} from 'react';
import {Link, Navigate} from 'react-router-dom';
import axios from 'axios';
import swal from 'sweetalert2';

import NavBar from '../../layouts/frontend/NavBar';

class Users extends Component
{
    state = {
        is_loading: true,
        users: [],
        is_logged_in: false,
    }

    async componentDidMount() {
        let flag = false;

        if (localStorage.length>0) {
            flag = (localStorage.getItem('user')!==undefined && localStorage.getItem('user')!=='');

            this.setState({
                is_logged_in: flag,
            });

            if (flag) {
                const res = await axios.get('http://127.0.0.1:8000/api/users');
                if (res.data.status === 200) {
                    this.setState({
                        is_loading: false,
                        users: res.data.users,
                    });
                }
            }
        }
    }

    handleDelete = async (e, id) => {
        const currentClickedElement = e.currentTarget;
        currentClickedElement.innerText = "Deleting...";

        swal.fire({
            title: 'Are you sure?',
            text: 'You wont be able to revert this.',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#3085d6'
        }).then(async (result) => {

            if (result.isConfirmed) {
                const res = await axios.delete(`http://127.0.0.1:8000/api/delete-user/${id}`);
                if (res.data.status === 200) {
                    currentClickedElement.closest('tr').remove();
                    swal.fire({
                        title: 'Deleted!',
                        text: res.data.message,
                        icon: 'success',
                        confirmButtonText: 'OK',
                    });
                } else {
                    currentClickedElement.closest('tr').remove();
                    swal.fire({
                        title: 'Deletion Failed',
                        text: res.data.message,
                        icon: 'warning',
                        confirmButtonText: 'OK',
                    });
                }
            } else {
                currentClickedElement.innerText = "Delete";
            }
        });        
    }

    convertPermission = (permission) => {
        if (permission === 1) {
            return(<span>Super Admin</span>)
        } else if (permission === 2) {
            return(<span>Admin</span>)
        } else if (permission === 3) {
            return(<span>Editor</span>)
        } else if (permission === 4) {
            return(<span>Viewer</span>)
        }
    }

    render()
    {
        let html_elems = "";
        let {is_loading, is_logged_in} = this.state;

        if (is_logged_in) {
            if (is_loading) {
                html_elems = <tr><td colSpan="8"><h2>Loading...</h2></td></tr>
            } else {
                html_elems = this.state.users.map((item) => {
                    return(
                        <tr key={item.id}>
                            <td>{item.name}</td>
                            <td>{item.email}</td>
                            <td>{this.convertPermission(item.permission)}</td>
                            <td>{item.active===1 ? "Yes" : "No"}</td>
                            <td><button onClick={(e) => this.handleDelete(e, item.id)} className="btn btn-danger btn-sm">Delete</button></td>
                        </tr>
                    )
                });
            }
        }

        return(
            <div>
                {/* {!is_logged_in && (<Navigate to="/unauthorized" />)} */}
                <NavBar />
                <div className="container">                
                    <div className="row">
                        <div className="col-md-12">
                            <div className="card">
                                <div className="card-header">
                                    <h3>Users
                                        {this.state.is_logged_in && (<Link to="/register" className="btn btn-success btn-sm float-end">Create New</Link>)}
                                    </h3>
                                </div>
                                <div className="card-body">
                                    <table className="table table-bordered table-stripe">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Permission</th>
                                                <th>Active</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {html_elems}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
        );
    }
}

export default Users;