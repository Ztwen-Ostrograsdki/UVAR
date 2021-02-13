<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Shopping;
use App\Models\ShoppingAction;
use App\Models\User;
use App\Traits\Validators\MembersValidators;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    use MembersValidators;

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
        if (!auth()->user()) {
            redirect('/');
        }
        return view('members.index');
    }

    public function getMembers()
    {
        $members = Member::all();

        return response()->json(['members' => $members]);
    }

    public function getMember(int $id)
    {
        $actions = [];
        $products = [];
        $member = Member::withTrashed('deleted_at')->where('id', $id)->first();
        if (count(ShoppingAction::where('member_id', $id)->get()) > 0) {
            $actions = $member->actions();
        }
        if (count(Shopping::where('user_id', $member->user->id)->get()) > 0) {
            $products = $member->shopping();
        }
        $account = $member->account();
        $referer = $member->referer();
        $referies = $member->referies();
        $bonuses = $member->bonuses();
        $image = $member->images;

        return response()->json(['member' => $member, 'myActions' => $actions, 'myAccount' => $account, 'myReferer' => $referer, 'myProducts' => $products, 'myReferies' => $referies, 'myBonuses' => $bonuses, 'myImage' => $image]);
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
    public function show(int $id)
    {
        if (!is_int($id)) {
            return abort(404, 'Page introuvable');
        }
        $member = Member::find($id);

        if (!$member) {
            return abort(404, 'Page introuvable');
        }
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
    public function update(Request $request, int $id)
    {
        if (auth()->user()->member && auth()->user()->member->id !== $id) {
            return abort(403, "Vous n'etes pas autorisé");
        }
        if (!is_int($id)) {
            return abort(404, 'Page introuvable');
        }
        $member = Member::find($id);
        $user = User::find($member->user_id);

        if (!$user || !$member) {
            return abort(404, 'Page introuvable');
        }
        
       $name = $request->name;
       $phone = $request->phone;
       $existed_name = Member::where('name', $name)->first();
       $existed_phone = Member::where('phone', $phone)->first();

       if ($existed_phone !== null && $existed_phone->id == $id && $existed_name !== null && $existed_name->id == $id) {
           $validators = null;
       }
       else{
            if ($existed_name !== null && $existed_name->id == $id) {
               $validators = $this->EditMemberValidator($request->all(), 'name');
           }
           elseif ($existed_phone !== null && $existed_phone->id == $id) {
               $validators = $this->EditMemberValidator($request->all(), 'phone');
           }
           else{
                $validators = $this->EditMemberValidator($request->all());
           }
       }

       if ($validators !== null && $validators->fails()) {
           return response()->json(['errors' => $validators->errors()]);
       }
       else{
            $member->update(['name' => $request->name, 'phone' => $request->phone, 'sexe' => $request->sexe, 'country' => $request->country]);
            $user->update(['name' => $request->name]);
            return response()->json(['success' => "Mise à jour des informations réussie"]);
       }

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
