<?php

namespace App\Repositories\UserPromotionCodes;

interface UserPromotionCodesRepositoryInterface
{
    /**
     * Set user promotion code data
     *
     * @param array $data data
     */
    public function setUserPromotionCodeData(array $data);

    /**
     * Store user promotion code
     */
    public function store();
}
