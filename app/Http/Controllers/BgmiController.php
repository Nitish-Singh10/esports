<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BgmiDuo;
use App\Models\BgmiSolo;
use App\Models\BgmiTeam;
use Illuminate\Http\Request;

class BgmiController extends Controller
{
    public function duo()
    {
        if (session()->has('username')) {
            $teams = BgmiDuo::all();
            $admin = Admin::all();
            return view('bgmi_duo', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
    public function solo()
    {
        if (session()->has('username')) {
            $teams = BgmiSolo::all();
            $admin = Admin::all();
            return view('bgmi_solo', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
    public function verifyTeam($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $team = BgmiTeam::findOrFail($id);
        $team->verified = 1;
        $team->save();

        return back()->with('success', 'Team verified successfully');
    }
    public function verifyDuo($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $duo = BgmiDuo::findOrFail($id);
        $duo->verified = 1;
        $duo->save();

        return back()->with('success', 'BGMI Duo verified successfully');
    }
    public function verifySolo($id)
    {
        if (!session()->has('username')) {
            return redirect('/admin');
        }

        $solo = BgmiSolo::findOrFail($id);
        $solo->verified = 1;
        $solo->save();

        return back()->with('success', 'BGMI Solo verified successfully');
    }
}
