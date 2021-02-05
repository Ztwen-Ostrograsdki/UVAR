<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\ShoppingAction;
use Illuminate\Http\Request;

class MembersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('members.index');
    }

    public function getMembers()
    {
        $members = Member::all();

        return response()->json(['members' => $members]);
    }

    public function getMember(int $id)
    {
        $member = Member::withTrashed('deleted_at')->where('id', $id)->first();
        $actions = $member->actions();
        $account = $member->account();
        $referer = $member->referer();
        $products = $member->shopping();

        return response()->json(['member' => $member, 'myActions' => $actions, 'myAccount' => $account, 'myReferer' => $referer, 'myProducts' => $products]);
    }

    public function getMemberProfil(int $id)
    {
        return $this->getMember($id);        
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
        return view('members.profil');
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
        
    }

    public function changeEmail(Request $request)
    {
        
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
