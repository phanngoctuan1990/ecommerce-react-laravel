import React from "react";
import ReactDOM from "react-dom";
import { Provider } from "react-redux";
import { Router } from "react-router-dom";
import AppRouter from "./routers/AppRouter";
import configureStore from "./store/configureStore";
import axios, { setAccessToken } from "./api/axiosInstance";
import { createBrowserHistory as createHistory } from "history";
import MuiThemeProvider from "material-ui/styles/MuiThemeProvider";

// Api
import { ACCESS_TOKEN } from "./api/strings";
import { getUserCartAPI } from "./api/apiURLs";

// Actions
import { addToCartHelper } from "./actions/shoppingCart";
import { loginUser, logoutUser } from "./actions/authentication";

const store = configureStore();

// initial load, check if user is logged in
const access_token = window.localStorage.getItem(ACCESS_TOKEN);
if (access_token) {
    setAccessToken(access_token);
    axios
        .get(getUserCartAPI)
        .then(response => {
            store.dispatch(loginUser());
            response.data.map(item => {
                const quantity = 1;
                const price = item.price;
                const productID = item.id;
                const ratings = item.ratings;
                const productName = item.name;
                const productImage = item.image;
                const sellerName = item.sellerName;
                const product = {
                    productName,
                    productImage,
                    sellerName,
                    ratings,
                    quantity,
                    price,
                    productID
                };
                store.dispatch(addToCartHelper(product));
            });
        })
        .catch(error => {
            window.localStorage.removeItem(ACCESS_TOKEN);
            store.dispatch(logoutUser());
        });
}

ReactDOM.render(
    <Provider store={store}>
        <MuiThemeProvider>
            <Router history={createHistory()}>
                <AppRouter />
            </Router>
        </MuiThemeProvider>
    </Provider>,
    document.getElementById("app")
);
