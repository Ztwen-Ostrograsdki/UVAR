<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Member;
use App\Models\Product;
use App\Models\RequestedAction;
use App\Models\ShoppingAction;
use App\Models\User;
use App\Notifications\ManageRequested;
use Illuminate\Http\Request;

class MarketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['buyAction']);
    }

    public function buyAction(int $act, int $memb, int $total)
    {
        $member = Member::find($memb);
        $action = Action::find($act);

        if ($action->bought) {
            return response()->json(['errors' => "Cette action n'est plus sur le marché!"]);
        }
        else{
            if ($action->boughtable($total)) {
                $newShop = RequestedAction::create(['action_id' => $act, 'member_id' => $memb, 'total' => $total]);
                if ($action->finish()) {
                    $action->update(['bought' => true]);
                }
                if ($newShop) {
                    $admin = User::where('role', 'admin')->first();
                    if ($admin) {
                        $admin->notify(new ManageRequested($newShop, 'action', $action, $member));
                    }
                    return response()->json(['success' => "Opération réussie! Pour entrer en Possession des actions veuillez faire un dépot de " . $total * $action->price . " FCFA sur le numero de la plateforme."]);
                    // return response()->json(['success' => "Opération réussie!", 'message' => "Pour entrer en Possession des actions veuillez faire un dépot sur le numero de la plateforme", 'tarif' => $total * $action->price . ' FCFA']);
                }
            }
            return response()->json(['errors' => "Vous ne pouvez que acheter au plus " . ($action->total - $action->totalBought()) . " actions"]);

        }
    }







	public function index()
	{
		return view('actions.index');
	}
    



    public function getAllActions()
    {
        $actions = Action::all();
        $allActions = [];
        $actionsDetails['lastAction'] = null;
        $actionsDetails['bestAction'] = null;
        $actionsDetails['bestTotalBought'] = 0;
        $actionsDetails['lastTotalBought'] = 0;

        if (count($actions) > 0) {
            $actionsDetails = Action::getActionsDetails();
        }


        foreach ($actions as $action) {
            if (!$action->bought) {
                $allActions[] = 
                    [
                        'action' => $action,
                        'totalBought' => $action->totalBought(),
                        'images' => $action->images,
                    ];
            }
        }
        return response()->json(['actions' => $allActions, 'actionsDetails' => $actionsDetails]);
    }

    public function getAllActionsOnlyAPart()
    {
        $actions = Action::all()->take(4);
        $allActions = [];

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

    public function getAllProducts()
    {
        $products = Product::all();
        $allproducts = [];

        foreach ($products as $p) {
            if (!$p->bought) {
                $allproducts[] = 
                    [
                        'product' => $p,
                        'totalBought' => $p->totalBought(),
                        'images' => $p->images,
                    ];
            }
        }
        return response()->json(['products' => $allproducts]);
    }

}
