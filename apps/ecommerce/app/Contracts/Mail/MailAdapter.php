<?php

namespace App\Contracts\Mail;

interface MailAdapter
{
    /**
     * Set detail
     *
     * @param array $detail detail
     *
     * @return this
     */
    public function setDetail(array $detail);

    /**
     * Set mail to
     *
     * @param string $mail mail
     *
     * @return this
     */
    public function setMailTo(string $mail);

    /**
     * Send mail order Placed
     *
     * @return void
     */
    public function sendMailOrderPlaced();
}
