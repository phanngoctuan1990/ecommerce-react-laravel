import React from "react";
import { withRouter } from "react-router-dom";

class HomePage extends React.Component {
    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Laravel & Reactjs</div>

                            <div className="card-body">
                                I'm an example component!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default withRouter(HomePage);
