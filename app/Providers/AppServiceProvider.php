<?php

namespace App\Providers;

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
        if (app()->runningInConsole()) {
            return;
        }

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('ai_providers')) {
                $defaultProvider = \App\Models\AiProvider::with(['vendor', 'aiModel'])
                    ->where('is_default', '=', true)
                    ->first();
                
                $vendor = $defaultProvider?->vendor;
                $aiModel = $defaultProvider?->aiModel;

                if ($defaultProvider && $vendor && $aiModel) {
                    $driverKey = (string) $vendor?->key;
                    config([
                        'ai.default' => $driverKey,
                        "ai.providers.{$driverKey}.driver" => $driverKey,
                        "ai.providers.{$driverKey}.key" => $defaultProvider->api_key,
                    ]);

                    if ($defaultProvider->base_url) {
                        config(["ai.providers.{$driverKey}.url" => $defaultProvider->base_url]);
                    }
                    
                    config(["ai.providers.{$driverKey}.model" => (string) $aiModel?->key]);
                    config(["ai.providers.{$driverKey}.web_search_enabled" => (bool) $defaultProvider->web_search_enabled]);
                }
            }
        } catch (\Exception $e) {
            // Silence errors during boot (e.g. migration not run yet)
        }
    }
}
