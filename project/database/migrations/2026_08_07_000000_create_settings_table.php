<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert SMTP configuration
        DB::table('settings')->insert([
            ['key' => 'mail_mailer', 'value' => 'smtp', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_host', 'value' => 'smtp.gmail.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_port', 'value' => '587', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_username', 'value' => 'makstech.uk@gmail.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_password', 'value' => 'shan lmnp pext lekd', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_encryption', 'value' => 'tls', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_from_address', 'value' => 'makstech.uk@gmail.com', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mail_from_name', 'value' => 'Green Web Project', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
