<?php

namespace App\Models;

use App\Models\Action;
use App\Models\Image;
use App\Models\Member;
use App\Models\Product;
use App\Models\Shopping;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'confirmation_token',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function member()
    {
        return $this->hasOne(Member::class); 
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageables'); 
    }

    public function products()
    {
        return $this->hasMany(Shopping::class);
    }

    /**
     * All transactions that he send
     * @return [type] [description]
     */
    public function __outTransactions()
    {

    }

    /**
     * All transactions that he receives
     * @return [type] [description]
     */
    public function __inTransactions()
    {
        
    }
}
