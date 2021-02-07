<?php

namespace App\Http\Controllers;

use App\Mail\Gmail;
use App\Models\Affiliate;
use App\Models\Member;
use App\Models\Product;
use App\Models\Shopping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = Member::all()->take(3)->orderBy('id', 'DESC');
        // $products = Product::all()->pluck('id')->toArray();
        //     foreach ($users as $user) {
        //         $ts = array_slice($products, 0, rand(1, 4));
        //         foreach ($ts as $t) {
        //             Shopping::create([
        //             "user_id" => $user->id,
        //             "product_id" => $t,
        //             "total" => rand(1, 10)
        //         ]);
        //         }
        //     }
        dd($users);
        // $mail  = Mail::to('fadyljohaness00@gmail.com')->send(new Gmail());
        // dd($mail);
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
