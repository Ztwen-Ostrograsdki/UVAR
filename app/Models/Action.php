<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Member;
use App\Models\RequestedAction;
use App\Models\ShoppingAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'price', 'actionnary', 'total', 'description'];

    public function author()
    {
    	return $this->belongsTo(Member::class);
    }

    public function totalBought()
    {
        $bought = array_sum(ShoppingAction::where('action_id', $this->id)->pluck('total')->toArray());
    	$demandes = array_sum(RequestedAction::where('action_id', $this->id)->pluck('total')->toArray());

        return ($bought + $demandes); 
    }

    public function shoppings()
    {
        return ShoppingAction::where('action_id', $this->id)->get();
    }

    public function boughtable($total)
    {
        return ($this->total - $this->totalBought()) > $total;
    }

    /**
     * Image profil of the member
     * @return [type] [description]
     */
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }


    





}
