<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\EFootball;
use Illuminate\Http\Request;

class EFootballController extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $teams = EFootball::all();
            $admin = Admin::all();
            return view('e_football', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
}
