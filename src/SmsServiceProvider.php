<?php

namespace Hashes02\DhiraaguBulkSms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('sms.sender', function ($app) {
            return new Services\SmsSender(
                config('sms.sender_id'),
                config('sms.client_id'),
                config('sms.authorization')
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/sms.php' => config_path('sms.php'),
        ]);
    }
}
