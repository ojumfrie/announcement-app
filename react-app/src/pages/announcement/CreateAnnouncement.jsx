import React, {Component} from 'react';
import {Link} from 'react-router-dom';
import axios from 'axios';
import swal from 'sweetalert2';
import {Navigate} from 'react-router';
import NavBar from '../../layouts/frontend/NavBar';
import Select from 'react-select';

class CreateAnnouncement extends Component
{
    state = {
        title: "",
        content: "",
        start_date: "",
        end_date: "",
        error_list: [],
        active: 1,
        is_to_go_back_home: false,
        is_logged_in: false,
    }

    componentDidMount() {
        this.setState({
            is_logged_in: (localStorage.getItem('user')!==undefined&&localStorage.getItem('user')!==''),
        });
    }

    handleInput = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    handleCreateAnnouncement = async (e) => {
        e.preventDefault();
        this.setState({active: 1});

        const res = await axios.post('http://localhost:8000/api/create-announcement', this.state);
        if (res.data.status === 200) {
            this.setState({
                title: "",
                content: "",
                start_date: "",
                end_date: "",
                active: 1,
                error_list: [],
                is_to_go_back_home: true,
            });

            swal.fire({
                title: 'Created!',
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
        let {is_to_go_back_home, is_logged_in} = this.state;
        let activeOptions = [{label: "Active", value: 1}, {label: "Inactive", value: 0}];

        return(
            <div>
                <NavBar />
                <div className="container">
                    {is_to_go_back_home && (<Navigate to="/" />)}

                    <div className="row">
                        <div className="col-md-9">
                            <div className="card">
                                <div  className="card-header">
                                    <h3>Create Announcement
                                        <Link to="/" className="btn btn-success btn-sm float-end">Back</Link>
                                    </h3>                                
                                </div>
                                <div className="card-body">
                                    <form onSubmit={this.handleCreateAnnouncement}>
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
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                            <span className="text-danger">{this.state.error_list.active}</span>
                                        </div>

                                        <div className="form-group mb-3">
                                            <button type="submit" className="btn btn-primary col-2 float-end">Create</button>
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

export default CreateAnnouncement;