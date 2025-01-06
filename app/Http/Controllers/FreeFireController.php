<?php

namespace App\Http\Controllers;

use App\Models\FreefireDuo;
use App\Models\FreefireSolo;
use App\Models\FreefireTeam;
use Illuminate\Http\Request;

class FreeFireController extends Controller
{
    public function team()
    {
        if (session()->has('username')) {
            $teams = FreefireTeam::all();
            return view('freefire_team', compact('teams'));
        } else {
            return redirect('/admin');
        }
    }

    public function duo()
    {
        if (session()->has('username')) {
            $teams = FreefireDuo::all();
            return view('freefire_duo', compact('teams'));
        } else {
            return redirect('/admin');
        }
    }
    public function solo()
    {
        if (session()->has('username')) {
            $teams = FreefireSolo::all();
            return view('freefire_solo', compact('teams'));
        } else {
            return redirect('/admin');
        }
    }
}
