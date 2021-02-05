<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Action;
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

    protected $fillable = ['level', 'amount', 'referer', 'country', 'sexe', 'AR-coin', 'phone', 'pseudo', 'IDENTIFY'];


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
    	return $this->belongsTo(User::class);
    }

    public function actions()
    {
        $actions = [];
        $totalPrices = 0;
        $totalActions = 0;
        $shops = ShoppingAction::where('member_id', $this->id)->get();
        $last = ShoppingAction::where('member_id', $this->id)->latest()->first();
        $lastAct = Action::find($last->action_id);
        if (true) {
            foreach ($shops as $shop) {
                $action = Action::find($shop->action_id);
                $actions[$shop->action_id] = [
                    'action' => $action,
                    'total' => $shop->total
                ];
                $totalPrices += ($shop->total)*($action->price);
                $totalActions += ($shop->total);
            }

            $actions['totalActions'] = $totalActions;
            $actions['totalPrices'] = $totalPrices;
            $actions['lastAction'] = ['total' => $last->total, 'action' => $lastAct];
        }

        return $actions;
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
        return Account::where('author', $this->id)->first();
    }

    public function shopping()
    {
        $products = $this->user->products;
        $shoppings = [];
        $totalPrices = 0;
        $totalProducts = 0;

        $last = Shopping::where('user_id', $this->user->id)->latest()->first();
        $lastPr = Product::find($last->product_id);
        if (true) {
            foreach ($products as $product) {
                $p = Product::find($product->product_id);
                $total = array_sum(Shopping::where('user_id', $this->user->id)->where('product_id', $p->id)->pluck('total')->toArray());
                $price = $total*$p->price;
                $shoppings[$p->id] = [
                    'total' => $total,
                    'product' => $p
                ];

                $totalProducts += $total;
                $totalPrices += $price;
            }
            $shoppings['totalProducts'] = $totalProducts;
            $shoppings['totalPrices'] = $totalPrices;
            $shoppings['lastProduct'] = ['total' => $last->total, 'product' => $lastPr];
        }

        return $shoppings;
    }



}
