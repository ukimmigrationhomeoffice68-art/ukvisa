<?php

namespace App\Providers;

use App\Models\Setting;
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
        $this->applyMailSettings();
    }

    /**
     * Override mail config at runtime with admin-configured SMTP settings.
     */
    protected function applyMailSettings(): void
    {
        try {
            if (!Schema::hasTable('settings')) {
                return;
            }

            $settings = Setting::allAsArray();

            if (empty($settings['mail_host'])) {
                return;
            }

            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => $settings['mail_host'],
                'mail.mailers.smtp.port' => $settings['mail_port'] ?? 587,
                'mail.mailers.smtp.username' => $settings['mail_username'] ?? null,
                'mail.mailers.smtp.password' => $settings['mail_password'] ?? null,
                'mail.mailers.smtp.encryption' => $settings['mail_encryption'] ?? 'tls',
                'mail.from.address' => $settings['mail_from_address'] ?? 'no-reply@greenwebproject.com',
                'mail.from.name' => $settings['mail_from_name'] ?? 'Green Web Project',
            ]);
        } catch (\Throwable $e) {
            // Fail silently — fall back to default mail config if DB is unavailable
        }
    }
}
