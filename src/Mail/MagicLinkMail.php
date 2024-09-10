<?php

namespace YottaHQ\Mail;

use Illuminate\Mail\Mailable;

class MagicLinkMail extends Mailable
{
    public function __construct(public string $token)
    {
    }

    public function build()
    {
        $url = route('magic.link.verify', $this->token);

        return $this->subject('Your Magic Link')
            ->markdown('emails.magic-link')
            ->with([
                'url' => $url,
            ]);
    }
}
