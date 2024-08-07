<?php

return [
    'auth_middleware' => [
        'auth',
    ],

    ######################################################################################################
    #                                                                                                    #
    #                                Multiple Email Address Configuration                                #
    #                                                                                                    #
    ######################################################################################################

    /*
     * The FQN name of the user email address model.
     */
    'user-email-address-model'           => \YottaHQ\LaravelExtendedAuth\Models\UserEmailAddress::class,

    /**
     * Whether you want to allow users to set unverified secondary email addresses as
     * their primary email address.
     */
    'allow_unverified_emails_as_primary' => false,

    /**
     * The number of minutes the email verification link expires.
     */
    'email_verification_link_expiry'     => 60,

    /**
     * An array of the middlewares that are required for the email verification url.
     * If you want to restrict email verification to authenticated users then
     * uncomment the auth middleware or add yours instead.
     */
    'verify_route_middleware'            => [
        'throttle:6,1',
        'signed',
        //'auth',
    ],

    /**
     * Whether you want to enable users to authenticate using any of their added email addresses
     * and not just the primary email address.
     */
    'authenticate_by_any_email'          => false,

    ######################################################################################################
    #                                                                                                    #
    #                             Two Factor Authentication Configuration                                #
    #                                                                                                    #
    ######################################################################################################

    'two-factor-device-model' => \YottaHQ\LaravelExtendedAuth\Models\TwoFactor::class,

    'laravel-extended-auth.recovery-code-block-length' => 10,

    'laravel-extended-auth.recovery-code-block-count'  => 2,

    'laravel-extended-auth.recovery-codes-count'       => 8,

    ######################################################################################################
    #                                                                                                    #
    #                                      Passwords Configuration                                       #
    #                                                                                                    #
    ######################################################################################################

    'passwords_table_name' => 'passwords',

    /**
     * Number of days until a password expires
     */
    'password_expires_in' => 90,

];
