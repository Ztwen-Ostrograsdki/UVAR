<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Image;
use App\Models\Member;
use App\Models\Product;
use App\Models\RequestedProducts;
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

    public function buyers()
    {
        return $this->hasMany(Shopping::class);
    }

    public function Usersbuyers()
    {
        $tables = [];
        $shops = $this->buyers()->with('user')->get();
        return $shops;
    }


    public function totalBought()
    {
        $bought = array_sum(Shopping::where('product_id', $this->id)->pluck('total')->toArray());
        $demandes = array_sum(RequestedProducts::where('product_id', $this->id)->pluck('total')->toArray());

        return ($bought + $demandes);     }


    public function shoppings()
    {
        return Shopping::where('product_id', $this->id)->get();
    }

    public function boughtable($total)
    {
        return ($this->total - $this->totalBought()) >= $total;
    }

    public function finish()
    {
        return ($this->total - $this->totalBought()) == 0;
    }

    public static function getProductsDetails()
    {
        $products = Product::all();
        $productDetails['lastProduct'] = null;
        $productDetails['bestProduct'] = null;
        $productDetails['bestTotalBought'] = 0;
        $productDetails['lastTotalBought'] = 0;
        $produtsTables = [];
        $produtsTables["max_key"] = 0;

        if (count($products) > 0) {
            $lastProduct = $products->last();
            $bestProduct = null;
            foreach ($products as $product) {
                $produtsTables[$product->id] = $product->totalBought();
                if ($product->totalBought() > $produtsTables['max_key']) {
                    $produtsTables['max_key'] = $product->totalBought();
                    $bestProduct = $product;
                }
            }

            $productDetails['lastProduct'] = $lastProduct;
            $productDetails['bestProduct'] = $bestProduct;
            $productDetails['bestTotalBought'] = $bestProduct->totalBought();
            $productDetails['lastTotalBought'] = $lastProduct->totalBought();
        }
        return $productDetails;
    }












}
