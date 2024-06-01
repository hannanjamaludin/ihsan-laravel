<?php

namespace App\Providers;

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('botman', function ($app) {
            DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
    
            // Define configuration options
            $config = [
                'web' => [
                    'matchingData' => [
                        'driver' => 'web',
                    ],
                ],
            ];
    
            Log::info('Creating BotMan instance');
    
            // Create and return the BotMan instance
            return BotManFactory::create($config);
        });
    }
        
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
