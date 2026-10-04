<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'phone_number',
    'date_of_birth',
    'nationality',
    'status',
    'valid_from',
    'valid_until',
    'national_insurance_number',
    'passport_number',
    'photo_path',
    'code',
    'code_valid_until',
    'otp_code',
    'otp_expires_at'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_of_birth' => 'date',
            'valid_from' => 'date',
            'valid_until' => 'date',
            'code_valid_until' => 'date',
            'otp_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
