<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       /*  $mailsetting = User::first();
        if ($mailsetting) {
            // Decrypt the password
            $decryptedPassword = Crypt::decryptString($mailsetting->password);

            // Set the decrypted password in the config
            config([
                'mail.customer.username' => $mailsetting->email,
                'mail.customer.password' => $decryptedPassword,
            ]);
        } */
    }
}
