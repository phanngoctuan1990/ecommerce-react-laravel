<?php

namespace App\Contracts\Mail;

use Log;
use Exception;
use Verifalia\VerifaliaRestClient;

class VerifyMail implements VerifyMailAdapter
{
    protected $email;

    /**
     * Set email
     *
     * @param string $email email
     *
     * @return VerifyMail
     */
    public function setEmail(string $email): VerifyMail
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Verify email
     *
     * @return bool
     */
    public function verify(): bool
    {
        $verifalia = new VerifaliaRestClient([
            'username' => config('mail.verfifalia_id'),
            'password' => config('mail.verfifalia_password')
        ]);

        $status = null;

        try {
            $validation = $verifalia
                ->emailValidations
                ->submit($this->email, true);

            $status = $validation->entries[0]->status;
        } catch (Exception $ex) {
            Log::error($ex);
            return false;
        }

        return strtolower(trim($status)) === 'success';
    }
}
