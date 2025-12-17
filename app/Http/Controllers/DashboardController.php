<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BgmiTeam;
use App\Models\GameRegistration;
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'game' => 'required|string',
            'category' => 'nullable|string',
            'amount' => 'required|integer',

            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'college' => 'required|string|max:255',

            'transaction_id' => 'required|string|unique:game_registrations,transaction_id',
        ]);

        GameRegistration::create([
            'game' => $validated['game'],
            'category' => $validated['category'] ?? null,
            'amount' => $validated['amount'],

            'full_name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'college_name' => $validated['college'],

            'transaction_id' => $validated['transaction_id'],
        ]);

        return redirect()->back()->with('success', 'Registration successful!');
    }
}
