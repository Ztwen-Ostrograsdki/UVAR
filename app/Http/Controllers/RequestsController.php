<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Member;
use App\Models\Product;
use App\Models\RequestedAction;
use App\Models\RequestedProducts;
use App\Models\User;
use Illuminate\Http\Request;

class RequestsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('requests.index');
    }


    public function getRequests($message = null)
    {
        $actionsTables = RequestedAction::all();
        $productsTables = RequestedProducts::all();

        $actionsRequests = [];
        $productsRequests = [];

        foreach ($actionsTables as $act_req) {
            $member = Member::find($act_req->member_id);
            $action = Action::find($act_req->action_id);
            $actionsRequests[] = 
                [
                    'member' => $member,
                    'action' => $action,
                    'request' => $act_req,
                    'type' => 'action',
                ];
        }

        foreach ($productsTables as $pr_req) {
            $user = User::find($pr_req->user_id);
            $product = Product::find($pr_req->product_id);
            $productsRequests[] = 
                [
                    'user' => $user,
                    'product' => $product,
                    'request' => $pr_req,
                    'type' => 'product',
                ];
        }
        if ($message !== null) {
            return response()->json(['actionsRequests' => $actionsRequests, 'productsRequests' => $productsRequests,  'message' => $message]);
        }
        return response()->json(['actionsRequests' => $actionsRequests, 'productsRequests' => $productsRequests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
