<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'zip' => 'required',
            'name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'first_address' => 'required',
            'amount_due' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|exists:payment_methods,name',
            'promotion_code_id' => 'nullable|exists:promotion_codes,id',
            'products' => 'required|array',
            'products.*' => 'required',
            'products.*.quantity' => 'required|integer',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.price' => 'required|numeric',
        ];
    }
}
