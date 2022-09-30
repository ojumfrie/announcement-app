import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import axios from 'axios';
import swal from 'sweetalert2';
import {Navigate} from 'react-router';
import NavBar from '../../layouts/frontend/NavBar';

class EditAnnouncement extends Component
{
    state = {
        id: 0,
        title: "",
        content: "",
        start_date: "",
        end_date: "",
        active: 0,
        error_list: [],
        is_to_go_back_home: false,
        is_logged_in: false,
    }

    captureId() {
        let location = window.location.href.split("/");
        return parseInt(location[location.length-1]);
    }

    async componentDidMount() {
        
        let announcement_id = this.captureId();
        let flag = false;

        if (localStorage.length>0) {
            flag = (localStorage.getItem('user')!==undefined && localStorage.getItem('user')!=='');

            this.setState({
                id: announcement_id,
                is_logged_in: flag,
            });
        }

        if (flag) {
            const res = await axios(`http://localhost:8000/api/edit-announcement/${announcement_id}`);
            if (res.data.status === 200) {
                this.setState({
                    title: res.data.announcement.title,
                    content: res.data.announcement.content,
                    start_date: res.data.announcement.start_date,
                    end_date: res.data.announcement.end_date,
                    active: res.data.announcement.active,
                });
            } else if (res.data.status === 404) {
                swal.fire({
                    title: 'Not Found',
                    text: res.data.message,
                    icon: 'warning',
                    confirmButtonText: 'OK',
                });
            } else {
                swal.fire({
                    title: 'Error Encountered',
                    text: res.data.message,
                    icon: 'warning',
                    confirmButtonText: 'OK',
                });
            }
        }
    }

    handleInput = (e) => {
        this.setState({
            [e.target.name]: e.target.value,
        });
    }

    handleUpdateAnnouncement = async (e) => {
        e.preventDefault();

        console.log(this.state);

        const res = await axios.put(`http://localhost:8000/api/update-announcement/${this.state.id}`, this.state);

        if (res.data.status === 200) {
            this.setState({
                id: 0,
                name: "",
                content: "",
                start_date: "",
                end_date: "",
                active: 0,
                error_list: [],
                is_to_go_back_home: true,
            });
            swal.fire({
                title: 'Updated!',
                text: res.data.message,
                icon: 'success',
                confirmButtonText: 'OK',
            });
        } else if (res.data.state === 404) {
            swal.fire({
                title: 'Error',
                text: res.data.message,
                icon: 'error',
                confirmButtonText: 'OK',
            });
        } else {
            this.setState({
                error_list: res.data.validation_error
            });
        }
    }

    render()
    {
        let {is_to_go_back_home} = this.state;

        console.log(this.state.active);
        console.log(typeof this.state.active);

        return(
            <div>
                <NavBar />
                <div className="container">
                    {(is_to_go_back_home) && <Navigate to="/" />}
                    <div className="row">
                        <div className="col-md-9">
                            <div className="card">
                                <div  className="card-header">
                                    <h3>Edit Announcement
                                        <Link to="/" className="btn btn-success btn-sm float-end">Back</Link>
                                    </h3>
                                </div>
                                <div className="card-body">
                                    <form onSubmit={this.handleUpdateAnnouncement}>
                                        <div className="form-group mb-3">
                                            <label>Title</label>
                                            <input type="text" name="title" onChange={this.handleInput} value={this.state.title} className="form-control" placeholder="Enter your title here" />
                                            <span className="text-danger">{this.state.error_list.title}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Content</label>
                                            <textarea name="content" onChange={this.handleInput} value={this.state.content} id="content-id" cols="15" rows="5" className="form-control"></textarea>
                                            <span className="text-danger">{this.state.error_list.content}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            
                                            <label>Start Date</label>
                                            <input type="date" name="start_date" onChange={this.handleInput} value={this.state.start_date} style={{width:180}} className="form-control" />                                        
                                            <span className="text-danger">{this.state.error_list.start_date}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>End Date</label>
                                            <input type="date" name="end_date" onChange={this.handleInput} value={this.state.end_date} style={{width:180}} className="form-control" />
                                            <span className="text-danger">{this.state.error_list.end_date}</span>
                                        </div>
                                        <div className="form-group mb-3">
                                            <label>Active</label>
                                            <select name="active" id="active" value={this.state.active} onChange={this.handleInput} style={{width:180}} className="form-select">
                                                {this.state.active===1 ? (<option value="1" default>Active</option>) : <option value="1">Active</option>}
                                                {this.state.active===0 ? (<option value="0" default>Inactive</option>) : <option value="0">Inactive</option>}
                                            </select>
                                            <span className="text-danger">{this.state.error_list.active}</span>
                                        </div>

                                        <div className="form-group mb-3">
                                            <button type="submit" className="btn btn-primary col-2 float-end">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default EditAnnouncement;