<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\ClashRoyal;

class ClashRoyalController extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $teams = ClashRoyal::all();
            $admin = Admin::all();
            return view('clash_royal', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
}
