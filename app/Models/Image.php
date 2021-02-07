<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    use HasFactory;

    protected $fillable = ['name'];

    public function product()
    {
    	return $this->morphedByMany(Product::class, 'imageable'); 
    }

    public function member()
    {
    	return $this->morphedByMany(Member::class, 'imageable'); 
    }



}
