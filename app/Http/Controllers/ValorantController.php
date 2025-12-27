<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Valorant;
use Illuminate\Http\Request;

class ValorantController extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $teams = Valorant::all();
            $admin = Admin::all();
            return view('valorant', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
    public function verify($id)
    {
        $team = Valorant::findOrFail($id);
        $team->verified = 1;
        $team->save();

        return redirect()->back()->with('success', 'Team verified successfully!');
    }
}
