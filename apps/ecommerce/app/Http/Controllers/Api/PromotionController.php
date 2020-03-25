<?php

namespace App\Http\Controllers\Api;

use App\Services\PromotionsService;
use App\Http\Requests\ValidatePromotionCodeRequest;

class PromotionController extends BaseApiController
{
    protected $promotionService;

    /**
     * Create a new controller instance.
     *
     * @param PromotionsService $promotionService promotion service
     *
     * @return void
     */
    public function __construct(PromotionsService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    /**
     * Validate promotion code.
     *
     * @param ValidatePromotionCodeRequest $request request
     *
     * @return json
     */
    public function validateCode(ValidatePromotionCodeRequest $request)
    {
        $promotionCode = $this->promotionService
            ->setPromotionCode($request->promo_code)
            ->validatePromotionCode();
        if ($promotionCode) {
            return $this->sendResponse($promotionCode);
        }
        return $this->sendResponse(['message' => 'Invalid promo code.'], 400);
    }
}
