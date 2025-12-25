<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CodSolo;
use App\Models\CodTeam;
use Illuminate\Http\Request;

class FCController extends Controller
{
    public function team()
    {
        if (session()->has('username')) {
            $teams = CodTeam::all();
            $admin = Admin::all();
            return view('cod_mobile_team', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }

    public function solo()
    {
        if (session()->has('username')) {
            $teams = CodSolo::latest()->get();
            $admin = Admin::all();
            return view('cod_mobile_solo', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }

    }
    public function verifyTeam($id)
    {
        $team = CodTeam::findOrFail($id);
        $team->verified = 1;
        $team->save();

        return redirect()->back()->with('success', 'Team verified successfully!');
    }

    public function verifySolo($id)
    {
        $team = CodSolo::findOrFail($id);
        $team->verified = 1;
        $team->save();

        return redirect()->back()->with('success', 'Team verified successfully!');
    }
}
