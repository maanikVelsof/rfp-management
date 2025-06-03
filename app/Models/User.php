<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @BOC
     * @Task #160741 Develop RFP Management System
     * @Author Maanik Arya 
     * @date 31-05-2025
     * @use_of_code: Created the vendor detail relationship for the rfp_management_system.
     * The user has one vendor detail therefore the relationship is one to one.
     */
    public function vendorDetail()
    {
        return $this->hasOne(\App\Models\RfpVendorDetail::class, 'user_id');
    }
    /**
     * @EOC
     */
}
