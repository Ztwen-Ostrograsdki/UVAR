<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Http\Request;

class MarketController extends Controller
{


	public function index()
	{
		return view('actions.index');
	}
    



    public function getAllActions()
    {
        $actions = Action::all();
        $allActions = [];

        $totalBoughtByAction = []
        ;
        foreach ($actions as $action) {
            $allActions[] = 
            [
                'action' => $action,
                'totalBought' => $action->totalBought(),
                'images' => $action->images,
            ];
        }
        return response()->json(['actions' => $allActions]);
    }

    public function getAllActionsOnlyAPart()
    {
        $actions = Action::all()->take(4);
        $allActions = [];

        $totalBoughtByAction = []
        ;
        foreach ($actions as $action) {
            $allActions[] = 
            [
                'action' => $action,
                'totalBought' => $action->totalBought(),
                'images' => $action->images,
            ];
        }
        return response()->json(['actions' => $allActions]);
    }

}
