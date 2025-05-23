<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRolesAndAbilities,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'role_id',
        'is_active',
        'contact_no',
        'remarks',
        'customer_code',
        'group_id',
        'referral',
        'upline',
        'credit_limit',
        'credit_amount',
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

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function getStatusNameAttribute()
    {
        return $this->is_active == 1 ? "Active" : "Inactive";
    }

    public function groupdetail()
    {
        return $this->belongsTo('App\Models\Group','group_id');
    }

    public function upline_id()
    {
        return $this->belongsTo('App\Models\User','upline');
    }
}
