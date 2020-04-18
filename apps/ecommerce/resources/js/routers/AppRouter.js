import React, { Component } from "react";
import { withRouter } from "react-router-dom";

import HomePage from "../components/HomePage";
import Header from "../components/common/Header";
import Footer from "../components/common/Footer";
import { BrowserRouter, Switch, Route } from "react-router-dom";

class AppRouter extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <BrowserRouter>
                <div>
                    <Header />
                    <Switch>
                        <Route path="/" component={HomePage} exact={true} />
                    </Switch>
                    <Footer />
                </div>
            </BrowserRouter>
        );
    }
}

export default withRouter(AppRouter);
