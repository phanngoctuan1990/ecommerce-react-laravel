import React, { Component } from "react";
import { withRouter } from "react-router-dom";
import { BrowserRouter, Switch, Route } from "react-router-dom";

// components
import HomePage from "../components/HomePage";
import NotFoundPage from "../components/NotFoundPage";

// common components
import Header from "../components/common/Header";
import Footer from "../components/common/Footer";

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
                        <Route component={NotFoundPage} />
                    </Switch>
                    <Footer />
                </div>
            </BrowserRouter>
        );
    }
}

export default withRouter(AppRouter);
