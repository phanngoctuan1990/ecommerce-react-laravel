<?php

namespace App\Repositories\Promotions;

use carbon\carbon;
use App\PromotionCode;

class PromotionsRepository implements PromotionsRepositoryInterface
{
    protected $code;
    protected $userId;
    protected $promotionCode;
    protected $currentDateTime;

    /**
     * Construct PromotionsRepository
     *
     * @param PromotionCode $model model
     *
     * @return void
     */
    public function __construct(PromotionCode $model)
    {
        $this->promotionCode = $model;
        $this->currentDateTime = Carbon::now();
    }

    /**
     * Set user id
     *
     * @param int $userId user id
     *
     * @return PromotionsRepository
     */
    public function setUserId(int $userId): PromotionsRepository
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Set promotion code
     *
     * @param string $code promotion code
     */
    public function setCode(string $code): PromotionsRepository
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get first active promotion code by user and code
     *
     * @return PromotionCode|null
     */
    public function firstActivePromotionByUserAndCode()
    {
        return $this->promotionCode->whereCode($this->code)
            ->where('start_date', '<', $this->currentDateTime->toDateTimeString())
            ->where('end_date', '>', $this->currentDateTime->toDateTimeString())
            ->with(['userPromotionCodes' => function ($query) {
                $query->where('user_id', $this->userId);
            }])->first();
    }
}
