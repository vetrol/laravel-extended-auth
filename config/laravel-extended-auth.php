<?php

return [
    ######################################################################################################
    #                                                                                                    #
    #                                Multiple Email Address Configuration                                #
    #                                                                                                    #
    ######################################################################################################

    /*
     * The name of the table where user email addresses are stored.
     * Customize this if you want to use a different table name.
     */
    'user_email_addresses_table' => 'user_email_addresses',

    /*
      * The fully qualified class name (FQN) of the user email address model.
      * This model will be used to handle secondary
      * email addresses for the users.
      */
    'user-email-address-model' => \YottaHQ\LaravelExtendedAuth\Models\UserEmailAddress::class,

    /*
     * Whether users can set an unverified secondary email address as their primary email.
     * If set to true, unverified emails can be promoted
     * to the primary email address.
     */
    'allow_unverified_emails_as_primary' => false,

    /*
     * The duration (in minutes) for which the email verification link remains valid.
     * After this time, the user will need to request a new link.
     */
    'email_verification_link_expiry' => 60,

    /*
     * Middleware array for the email verification URL.
     * Modify this if you want to add restrictions like requiring authentication for verification.
     * Uncomment the 'auth' middleware to restrict verification to authenticated users.
     */
    'verify_route_middleware' => [
        'throttle:6,1',
        'signed',
        //'auth', // Uncomment this if you want only authenticated users to verify email addresses
    ],

    /*
     * Whether to allow users to authenticate using any of their added email addresses.
     * If set to true, users can log in using any email (not just the primary one).
     */
    'authenticate_by_any_email' => false,

    ######################################################################################################
    #                                                                                                    #
    #                                MMagic Links Configuration                                #
    #                                                                                                    #
    ######################################################################################################

    /*
     * The name of the table where magic links are stored.
     * Customize this if you want to use a different table name.
     */
    'magic_links_table' => 'magic_links',

    /*
      * The fully qualified class name (FQN) of the user email address model.
      * This model will be used to handle secondary
      * email addresses for the users.
      */
    'magic_link_model' => \YottaHQ\LaravelExtendedAuth\Models\MagicLink::class,

    /*
     * The number of minutes the magic link should be valid for.
     */
    'magic_link_expiry' => 60, // Default is 1 hour

    /*
     * Middleware array for magic link routes.
     */
    'magic_link_route_middleware' => [
        'throttle:5,1',
        'signed',
    ],


    /*
     * The URL where users will be redirected after successfully verifying a magic link.
     * Customize this to send users to a specific location after login.
     */
    'magic_link_redirect_to' => '/dashboard',
];
