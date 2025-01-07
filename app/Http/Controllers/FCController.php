<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\FCSolo;
use Illuminate\Http\Request;

class FCController extends Controller
{
    public function solo()
    {
        if (session()->has('username')) {
            $teams = FCSolo::all();
            $admin = Admin::all();
            return view('fcmobile', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
}
