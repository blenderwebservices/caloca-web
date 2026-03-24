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
                $defaultProvider = \App\Models\AiProvider::where('is_default', true)->first();
                if ($defaultProvider) {
                    config([
                        'ai.default' => $defaultProvider->provider,
                        "ai.providers.{$defaultProvider->provider}.driver" => $defaultProvider->provider,
                        "ai.providers.{$defaultProvider->provider}.key" => $defaultProvider->api_key,
                    ]);

                    if ($defaultProvider->base_url) {
                        config(["ai.providers.{$defaultProvider->provider}.url" => $defaultProvider->base_url]);
                    }
                    
                    // We store the model and search flag in custom config keys so the Agent can use it
                    config(["ai.providers.{$defaultProvider->provider}.model" => $defaultProvider->model]);
                    config(["ai.providers.{$defaultProvider->provider}.web_search_enabled" => $defaultProvider->web_search_enabled]);
                }
            }
        } catch (\Exception $e) {
            // Silence errors during boot (e.g. migration not run yet)
        }
    }
}
