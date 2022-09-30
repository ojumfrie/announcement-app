import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import axios from 'axios';
import swal from 'sweetalert2';

import NavBar from '../../layouts/frontend/NavBar';

class Announcements extends Component
{
    state = {
        is_loading: true,
        announcements: [],
        is_logged_in: false,
    }

    async componentDidMount() {
        let flag = false; // true means logged in

        if (localStorage.length>0) {
            flag = (localStorage.getItem('user')!==undefined && localStorage.getItem('user')!=='');
            this.setState({
                is_logged_in: flag,
            });
        }

        if (flag) {
            const res = await axios.get('http://127.0.0.1:8000/api/announcements');
            if (res.data.status === 200) {
                this.setState({
                    is_loading: false,
                    announcements: res.data.announcements,
                });
            }
        } else {
            const res = await axios.get('http://127.0.0.1:8000/api/announcements-public');
            if (res.data.status === 200) {
                this.setState({
                    is_loading: false,
                    announcements: res.data.announcements,
                });
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
                const res = await axios.delete(`http://127.0.0.1:8000/api/delete-announcement/${id}`);
                if (res.data.status === 200) {
                    currentClickedElement.closest('tr').remove();
                    swal.fire({
                        title: 'Deleted!',
                        text: res.data.message,
                        icon: 'success',
                        confirmButtonText: 'OK',
                    });
                }
            } else {
                currentClickedElement.innerText = "Delete";
            }
        });        
    }

    render()
    {
        const {announcements, is_loading} = this.state;
        let html_elems = <tr><td colSpan={8}>Loading...</td></tr>;

        if (announcements.length) {
            if (is_loading) {
                html_elems = <tr><td colSpan="8"><h2>Loading...</h2></td></tr>
            } else {
                html_elems = announcements.map((item) => {
                    return(
                        <tr key={item.id}>
                            <td>{item.id}</td>
                            <td>{item.title}</td>
                            <td>{item.content}</td>
                            <td>{item.start_date}</td>
                            <td>{item.end_date}</td>
                            <td>{item.active===1 ? "Yes" : "No"}</td>
                            {this.state.is_logged_in && (<td><Link className="btn btn-primary btn-sm" to={`/edit-announcement/${item.id}`}>Edit</Link></td>)}
                            {this.state.is_logged_in && (<td><button onClick={(e) => this.handleDelete(e, item.id)} className="btn btn-danger btn-sm">Delete</button></td>)}
                        </tr>
                    )
                });
            }
        }

        return(
            <div>
                <NavBar />
                <div className="container">                
                    <div className="row">
                        <div className="col-md-12">
                            <div className="card">
                                <div className="card-header">
                                    <h3>Announcements
                                        {this.state.is_logged_in && (<Link to="/create-announcement" className="btn btn-success btn-sm float-end">Create New</Link>)}
                                    </h3>
                                </div>
                                <div className="card-body">
                                    <table className="table table-bordered table-stripe">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Active</th>
                                                {this.state.is_logged_in && (<th>Edit</th>)}
                                                {this.state.is_logged_in && (<th>Delete</th>)}
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

export default Announcements;