import { v1 as uuid } from "uuid";
import { ADD_TO_CART } from "../api/strings";

// ADD_TO_CART
export const addToCartHelper = ({
    productName,
    productImage = undefined,
    sellerName,
    ratings = undefined,
    quantity = 1,
    price,
    productID
} = {}) => ({
    type: ADD_TO_CART,
    shoppingCart: {
        id: uuid(),
        productName,
        productImage,
        sellerName,
        ratings,
        quantity,
        price,
        productID
    }
});
