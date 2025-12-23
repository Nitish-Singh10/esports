<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\GameRegistration;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request)
    {
        if (session()->has('username')) {
            $admin = Admin::all();
            $registrations = GameRegistration::latest()->get();
            return view('web', compact('registrations', 'admin'));
        } else {
            return redirect('/admin');
        }

    }
}
