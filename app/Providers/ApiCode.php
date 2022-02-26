<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiCode extends ServiceProvider
{

    public const SOMETHING_WENT_WRONG = 250;
    public const INVALID_CREDENTIALS = 251;
    public const VALIDATION_ERROR = 252;
    public const INVALID_EMAIL_VERIFICATION_URL = 253;
    public const EMAIL_ALREADY_VERIFIED = 254;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}