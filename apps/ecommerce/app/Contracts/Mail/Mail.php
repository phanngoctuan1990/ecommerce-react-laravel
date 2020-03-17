<?php

namespace App\Contracts\Mail;

use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail as LaravelMail;

class Mail implements MailAdapter
{
    protected $mail;
    protected $detail;

    /**
     * Set detail
     *
     * @param array $detail detail
     *
     * @return Mail
     */
    public function setDetail(array $detail): Mail
    {
        $this->detail = $detail;
        return $this;
    }

    /**
     * Set mail to
     *
     * @param string $mail mail
     *
     * @return this
     */
    public function setMailTo(string $mail): Mail
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * Send mail order Placed
     *
     * @return void
     */
    public function sendMailOrderPlaced()
    {
        LaravelMail::to($this->mail)->send(new OrderPlaced($this->detail));
    }
}
