<?php

namespace App\Http\Controllers;

use App\Models\FCSolo;
use Illuminate\Http\Request;

class FCController extends Controller
{
    public function solo()
    {
        if (session()->has('username')) {
            $teams = FCSolo::all();
            return view('fcmobile', compact('teams'));
        } else {
            return redirect('/admin');
        }
    }
}
