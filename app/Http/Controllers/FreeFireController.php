<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
            $admin = Admin::all();
            return view('freefire_team', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }

    public function duo()
    {
        if (session()->has('username')) {
            $admin = Admin::all();
            $teams = FreefireDuo::all();
            return view('freefire_duo', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
    public function solo()
    {
        if (session()->has('username')) {
            $teams = FreefireSolo::all();
            $admin = Admin::all();
            return view('freefire_solo', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
    public function verifyTeam($id)
    {

        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $team = FreefireTeam::findOrFail($id);
        $team->verified = 1;
        $team->save();

        return back()->with('success', 'Free Fire Team verified successfully');
    }
    public function verifyDuo($id)
    {
        $team = FreefireDuo::findOrFail($id);
        $team->verified = 1;
        $team->save();

        return redirect()->back()->with('success', 'Team verified successfully!');
    }
    public function verifySolo($id)
    {
        $team = FreefireSolo::findOrFail($id);
        $team->verified = 1;
        $team->save();

        return redirect()->back()->with('success', 'Team verified successfully!');
    }
}
