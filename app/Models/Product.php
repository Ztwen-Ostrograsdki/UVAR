<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Image;
use App\Models\Member;
use App\Models\Shopping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['price', 'description', 'bought', 'poster', 'total', 'name'];




    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable'); 
    }

    public function poster()
    {
        return $this->belongsTo(Member::class);
    }

    public function editor()
    {
        
    }


    public function totalBought()
    {
        return array_sum(Shopping::where('product_id', $this->id)->pluck('total')->toArray());
    }


    /**
     * List of who bought this product
     * @return [type] [description]
     */
    public function shoppers()
    {
    	
    }









}
