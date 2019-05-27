<?php

namespace App\Traits;

use App\Notifications\VerifyEmail;

trait MustVerifyEmail
{
    
    /**
     * Send the email verification notification.
     *
     * @return voids
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail($route = property_exists($this, 'verificationRoute') ? $this->verificationRoute : 'verification.verify'));
    }
}
