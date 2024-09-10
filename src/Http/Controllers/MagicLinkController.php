<?php

namespace YottaHQ\LaravelExtendedAuth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use YottaHQ\LaravelExtendedAuth\Exceptions\MagicLinkExpiredException;
use YottaHQ\LaravelExtendedAuth\Models\MagicLink;

class MagicLinkController
{
    /**
     * Send a magic link to the user's email.
     */
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = config('laravel-extended-auth.user-model')::where('email', $request->email)->firstOrFail();

        $magicLink = MagicLink::createForUser($user);

        Mail::to($user->email)->send(new \App\Mail\MagicLinkMail($magicLink->token));

        return response()->json(['message' => 'Magic link sent to your email!']);
    }

    /**
     * @throws MagicLinkExpiredException
     */
    public function verify(string $token)
    {
        $magicLink = MagicLink::where('token', $token)->firstOrFail();

        if ($magicLink->isExpired()) {
            throw new MagicLinkExpiredException();
        }

        Auth::login($magicLink->magic_linkable);

        $magicLink->delete();

        return redirect()->intended(config('laravel-extended-auth.magic_link_redirect_to', '/'));
    }
}
