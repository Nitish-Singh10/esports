<?php

namespace App\Http\Controllers;

use App\Models\BgmiDuo;
use App\Models\BgmiSolo;
use Illuminate\Http\Request;

class BgmiController extends Controller
{
    public function duo()
    {
        if (session()->has('username')) {
            $teams = BgmiDuo::all();
            return view('bgmi_duo', compact('teams'));
        } else {
            return redirect('/admin');
        }
    }

    public function solo()
    {
        if (session()->has('username')) {
            $teams = BgmiSolo::all();
            return view('bgmi_solo', compact('teams'));
        } else {
            return redirect('/admin');
        }
    }
}
