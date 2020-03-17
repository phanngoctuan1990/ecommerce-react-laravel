<?php

namespace App\Repositories\UserPromotionCodes;

use App\UserPromotionCode;

class UserPromotionCodesRepository implements UserPromotionCodesRepositoryInterface
{
    protected $userPromotionCode;
    protected $userPromotionCodeData;

    /**
     * Construct UserPromotionCodesRepository
     *
     * @param Product $model model
     *
     * @return void
     */
    public function __construct(UserPromotionCode $model)
    {
        $this->userPromotionCode = $model;
    }

    /**
     * Set user promotion code data
     *
     * @param array $data data
     *
     * @return UserPromotionCodesRepository
     */
    public function setUserPromotionCodeData(array $data): UserPromotionCodesRepository
    {
        $this->userPromotionCodeData = $data;
        return $this;
    }

    /**
     * Store user promotion code
     *
     * @return UserPromotionCode
     */
    public function store(): UserPromotionCode
    {
        return $this->userPromotionCode->create($this->userPromotionCodeData);
    }
}
