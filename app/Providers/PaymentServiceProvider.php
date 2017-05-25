<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(
            'payment', function($app) {
                return new \App\Services\Payment\Payment;
            }
//                'App\Services\Payment\Payment'
        );
//        $this->app->bind(
//                'payment',
//                'App\Services\Payment\Payment'
//        );
    }

}
