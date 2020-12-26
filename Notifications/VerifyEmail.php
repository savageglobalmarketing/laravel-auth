<?php

namespace SavageGlobalMarketing\Auth\Notifications;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;

class VerifyEmail extends BaseVerifyEmail
{
    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $prefix = trim(config('foundation.frontend.url'), '/') . '/' . trim(config('foundation.frontend.email_verify_url'), '/') . '/';

        $temporarySignedURL = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'uuid' => $notifiable->uuid,
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        $info = trim(Str::replaceFirst(config('foundation.api.prefix') . '/auth/email/verify', '', $temporarySignedURL), '/');

        return $prefix . $info;
    }
}
