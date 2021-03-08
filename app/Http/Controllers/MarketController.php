<?php

namespace App\Http\Controllers;

use App\ModelsHelpers\Authenticators\IDManager;
use App\Models\Action;
use App\Models\Member;
use App\Models\Product;
use App\Models\RequestedAction;
use App\Models\RequestedProducts;
use App\Models\ShoppingAction;
use App\Models\User;
use App\Models\Visitors;
use App\Notifications\ManageRequested;
use App\Notifications\NewVisitorNotification;
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
                }
            }
            return response()->json(['errors' => "Vous ne pouvez que acheter au plus " . ($action->total - $action->totalBought()) . " actions"]);

        }
    }

    public function buyProduct(int $prod, int $us, int $total)
    {
        $user = User::find($us);
        $product = Product::find($prod);

        if ($product->bought) {
            return response()->json(['errors' => "Cette action n'est plus sur le marché!"]);
        }
        else{
            if ($product->boughtable($total)) {
                $newShop = RequestedProducts::create(['product_id' => $prod, 'user_id' => $us, 'total' => $total]);
                if ($product->finish()) {
                    $product->update(['bought' => true]);
                }
                if ($newShop) {
                    $admin = User::where('role', 'admin')->first();
                    if ($admin) {
                        $admin->notify(new ManageRequested($newShop, 'article', $product, $user));
                    }
                    return response()->json(['success' => "Opération réussie! Pour entrer en Possession des articles veuillez faire un dépot de " . $total * $product->price . " FCFA sur le numero de la plateforme."]);
                }
            }
            return response()->json(['errors' => "Vous ne pouvez que acheter au plus " . ($product->total - $product->totalBought()) . " articles"]);

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

    public function getSelected(int $size = 3)
    {
        IDManager::__INCREMENT_VISITORS();

        $actions = Action::all()->shuffle()->take($size);
        $products = Product::all()->shuffle()->take($size);
        $selectedProducts = [];
        $selectedActions = [];

        foreach ($actions as $action) {
            $selectedActions[] = 
            [
                'action' => $action,
                'totalBought' => $action->totalBought(),
                'images' => $action->images,
            ];
        }

        foreach ($products as $product) {
            if (!$product->bought) {
                $selectedProducts[] = 
                    [
                        'product' => $product,
                        'totalBought' => $product->totalBought(),
                        'images' => $product->images,
                    ];
            }
        }
        return response()->json(['selectedActions' => $selectedActions, 'selectedProducts' => $selectedProducts]);
    }

    public function getAllProducts()
    {
        $products = Product::all();
        $allProducts = [];
        $productsDetails['lastProduct'] = null;
        $productsDetails['bestProduct'] = null;
        $productsDetails['bestTotalBought'] = 0;
        $productsDetails['lastTotalBought'] = 0;

        if (count($products) > 0) {
            $productsDetails = Product::getProductsDetails();
        }


        foreach ($products as $product) {
            if (!$product->bought) {
                $allProducts[] = 
                    [
                        'product' => $product,
                        'totalBought' => $product->totalBought(),
                        'images' => $product->images,
                    ];
            }
        }
        return response()->json(['products' => $allProducts, 'productsDetails' => $productsDetails]);
    }

}
