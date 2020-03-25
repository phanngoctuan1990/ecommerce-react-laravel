<?php

namespace App\Repositories\Promotions;

interface PromotionsRepositoryInterface
{
    /**
     * Set user id
     *
     * @param int $userId user id
     */
    public function setUserId(int $userId);

    /**
     * Set promotion code
     *
     * @param string $code promotion code
     */
    public function setCode(string $code);

    /**
     * Get first active promotion code by user and code
     */
    public function firstActivePromotionByUserAndCode();
}
