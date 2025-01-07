<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BgmiTeam;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (session()->has('username')) {
            $teams = BgmiTeam::all();
            $admin = Admin::all();
            return view('bgmi_team', compact('teams', 'admin'));
        } else {
            return redirect('/admin');
        }
    }
}
