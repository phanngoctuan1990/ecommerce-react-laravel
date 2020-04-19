import _ from "lodash";
import { ADD_TO_CART } from "../api/strings";

const shoppingCartReducerDefaultState = [];

// Reducer which is a pure function
export default (state = shoppingCartReducerDefaultState, action) => {
    switch (action.type) {
        case ADD_TO_CART:
            let idExists = _.find(
                state,
                item =>
                    item.productID.toString() ===
                    action.shoppingCart.productID.toString()
            );
            if (idExists) {
                return state;
            }
            return [...state, action.shoppingCart];

        default:
            return state;
    }
};
