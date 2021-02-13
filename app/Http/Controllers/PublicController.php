<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function getToken()
    {
        $token = csrf_token();
        return response()->json(['token' => $token]);
    }
}
