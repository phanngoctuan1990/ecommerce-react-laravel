<?php

namespace App\Contracts\Mail;

interface VerifyMailAdapter
{
    const IS_VALID = true;

    /**
     * Set email
     *
     * @param string $email email
     *
     * @return this
     */
    public function setEmail(string $email);

    /**
     * Verify email
     *
     * @return bool
     */
    public function verify();
}
