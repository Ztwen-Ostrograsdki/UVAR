<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Image;
use App\Models\Product;
use App\Models\ShoppingAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['level', 'amount', 'country', 'sexe', 'AR-coin', 'phone', 'pseudo', 'IDENTIFY'];


    /**
     * Get the member who refere the current member
     * @return [type] [description]
     */
    public function referer()
    {
    	return Member::withTrashed('deleted_at')->whereId($this->referer)->first();
    }

    /**
     * Image profil of the member
     * @return [type] [description]
     */
    public function images()
    {
        return $this->ManyToMany(Image::class);
    }

    /**
     * Get all members refered by the current member
     * @return [type] [description]
     */
    public function referies()
    {
    	return Member::withTrashed('deleted_at')->where('referer', $this->id)->get();
    }


    /**
     * Get the user lied to this member
     * @return [type] [description]
     */
    public function user()
    {
    	return $this->hasMany(User::class);
    }

    public function actions()
    {
        return $this->HasMany(ShoppingAction::class);
    }


    /**
     * Get all products posted by the member
     * @return [type] [description]
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }



}
