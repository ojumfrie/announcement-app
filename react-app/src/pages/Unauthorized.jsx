import React, {Component} from 'react';
import {Link} from 'react-router-dom';

class Unauthorized extends Component
{
    render()
    {
        return(
            <div className="mt-3">
                <div className="container">                
                    <div className="row">
                        <div className="col-md-12">
                            <div className="card px-2">
                                <h2 style={{color: 'red'}}>Sorry, you are not authorized to access the page.</h2>
                                <br />
                                <p>Go to Landing page <b><Link to='/'>here.</Link></b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Unauthorized;