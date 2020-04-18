import React from "react";
import ReactDOM from "react-dom";
import { Router } from "react-router-dom";
import AppRouter from "./routers/AppRouter";
import { createBrowserHistory as createHistory } from "history";
import MuiThemeProvider from "material-ui/styles/MuiThemeProvider";

ReactDOM.render(
    <MuiThemeProvider>
        <Router history={createHistory()}>
            <AppRouter />
        </Router>
    </MuiThemeProvider>,
    document.getElementById("app")
);
