<?php

namespace App\Models;
use App\Models\Chat;
use App\Models\Invoice;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lname',
        'email',
        'password',
        'mobile',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'company_name',
        'ein_number',
        'company_mobile',
        'company_address',
        'company_city',
        'company_state',
        'company_country',
        'company_zip_code',
        'profile_image',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
public function messages()
{
  return $this->hasMany(Chat::class);
}
public function invoice(){
    return $this->hasMany(Invoice::class);
}
}
