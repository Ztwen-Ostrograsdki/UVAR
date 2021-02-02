<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Image;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['authorized', 'price', 'creator', 'editor', 'quantity', 'name'];




    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageables'); 
    }

    public function poster()
    {
        return $this->belongsTo(Member::class);
    }

    public function editor()
    {
        
    }


    /**
     * List of who bought this product
     * @return [type] [description]
     */
    public function shoppers()
    {
    	
    }









}
