<?php

namespace App\Services;

use App\PromotionCode;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Promotions\PromotionsRepositoryInterface;

class PromotionsService extends BaseService
{
    protected $promotionCode;

    /**
     * Create a new controller instance.
     *
     * @param PromotionsRepositoryInterface $promotionsRepo promotion repository
     *
     * @return void
     */
    public function __construct(PromotionsRepositoryInterface $promotionsRepo)
    {
        $this->promotionsRepo = $promotionsRepo;
    }

    /**
     * Set promotion code
     *
     * @param string promotionCode promotion code
     *
     * @return PromotionsService
     */
    public function setPromotionCode(string $promotionCode): PromotionsService
    {
        $this->promotionCode = $promotionCode;
        return $this;
    }

    /**
     * Validate promotion code
     *
     * @return PromotionCode
     */
    public function validatePromotionCode()
    {
        return $this->promotionsRepo
            ->setUserId(Auth::user()->id)
            ->setCode($this->promotionCode)
            ->firstActivePromotionByUserAndCode();
    }
}
