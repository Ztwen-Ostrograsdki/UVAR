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

    protected $fillable = ['name', 'price', 'actionnary', 'total', 'description', 'bought'];

    public function author()
    {
    	return $this->belongsTo(Member::class);
    }

    public function buyers()
    {
        return $this->hasMany(ShoppingAction::class);
    }

    public function Membersbuyers()
    {
        $tables = [];
        $shops = $this->buyers()->with('member')->get();
        if (count($shops) > 0) {
            foreach ($shops as $shop) {
                $tables[] = ['member' => $shop->member, 'shop' => $shop, 'images' => $shop->member->images];
            }
        }
        return $tables;
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
        return ($this->total - $this->totalBought()) >= $total;
    }

    public function finish()
    {
        return ($this->total - $this->totalBought()) == 0;
    }

    public static function getActionsDetails()
    {
        $actions = Action::all();
        $actionsDetails['lastAction'] = null;
        $actionsDetails['bestAction'] = null;
        $actionsDetails['bestTotalBought'] = 0;
        $actionsDetails['lastTotalBought'] = 0;
        $actionsTables = [];
        $actionsTables["max_key"] = 0;

        if (count($actions) > 0) {
            $lastAction = $actions->last();
            $bestAction = null;
            foreach ($actions as $action) {
                $actionsTables[$action->id] = $action->totalBought();
                if ($action->totalBought() > $actionsTables['max_key']) {
                    $actionsTables['max_key'] = $action->totalBought();
                    $bestAction = $action;
                }
            }

            $actionsDetails['lastAction'] = $lastAction;
            $actionsDetails['bestAction'] = $bestAction;
            $actionsDetails['bestTotalBought'] = $bestAction->totalBought();
            $actionsDetails['lastTotalBought'] = $lastAction->totalBought();
        }
        return $actionsDetails;
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
