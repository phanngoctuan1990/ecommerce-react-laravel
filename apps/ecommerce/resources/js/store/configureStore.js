import { createStore, combineReducers, applyMiddleware } from "redux";
import thunk from "redux-thunk";

// Reducers
import shoppingCartReducer from "../reducers/shoppingcart";
import authenticationReducer from "../reducers/authentication";

const rootReducer = combineReducers({
    shoppingCart: shoppingCartReducer,
    authentication: authenticationReducer
});

export default () => createStore(rootReducer, applyMiddleware(thunk));
