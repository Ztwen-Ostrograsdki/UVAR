<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Member;
use App\Models\Product;
use App\Models\RequestedAction;
use App\Models\RequestedProducts;
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
        $actionsRequests = RequestedAction::all();
        $productsRequests = RequestedProducts::all();

        $requests = [];

        foreach ($actionsRequests as $act_req) {
            $member = Member::find($act_req->member_id);
            $action = Action::find($act_req->action_id);

            $requests[] = 
                [
                    'member' => $member,
                    'action' => $action,
                    'request' => $act_req,
                    'type' => 'action',
                ];
        }

        foreach ($productsRequests as $pr_req) {
            $member = Member::find($pr_req->member_id);
            $product = Product::find($pr_req->product_id);
            $requests[] = 
                [
                    'member' => $member,
                    'product' => $product,
                    'request' => $pr_req,
                    'type' => 'product',
                ];
        }
        if ($message !== null) {
            return response()->json(['requests' => $requests, 'message' => $message]);
        }
        return response()->json(['requests' => $requests]);
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
