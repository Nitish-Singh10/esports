<?php

namespace App\Http\Controllers;

use App\Models\BgmiTeam;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $teams = BgmiTeam::all();
            return view('bgmi_team', compact('teams'));
        } else {
            return redirect('/admin');
        }
    }
}
