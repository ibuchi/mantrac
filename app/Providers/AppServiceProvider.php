<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        $this->bootResponseMacros();
    }

    public function bootResponseMacros()
    {
        Response::macro('api', function ($response, $status = 200) {

            $format = ['status' => ($status < 400), 'message' => '', 'data' => []];

            // For convenience, if $response is a string, we'll use it as the message...
            if (is_string($response)) $response = ['message' => $response];

            return response(array_merge($format, $response), $status);
        });
    }
}
