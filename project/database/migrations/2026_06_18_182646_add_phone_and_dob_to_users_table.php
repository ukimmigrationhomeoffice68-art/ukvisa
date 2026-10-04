<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'date_of_birth')) $table->date('date_of_birth')->nullable();
            if (!Schema::hasColumn('users', 'nationality')) $table->string('nationality')->nullable();
            if (!Schema::hasColumn('users', 'status')) $table->string('status')->nullable();
            if (!Schema::hasColumn('users', 'valid_from')) $table->date('valid_from')->nullable();
            if (!Schema::hasColumn('users', 'valid_until')) $table->date('valid_until')->nullable();
            if (!Schema::hasColumn('users', 'national_insurance_number')) $table->string('national_insurance_number')->nullable()->unique();
            if (!Schema::hasColumn('users', 'photo_path')) $table->string('photo_path')->nullable();
            if (!Schema::hasColumn('users', 'code')) $table->string('code')->nullable()->unique();
            if (!Schema::hasColumn('users', 'code_valid_until')) $table->date('code_valid_until')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'nationality',
                'status',
                'valid_from',
                'valid_until',
                'national_insurance_number',
                'photo_path',
                'code',
                'code_valid_until'
            ]);
        });
    }
};
