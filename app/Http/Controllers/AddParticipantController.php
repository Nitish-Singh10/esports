<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BgmiDuo;
use App\Models\BgmiSolo;
use App\Models\BgmiTeam;
use App\Models\FCSolo;
use App\Models\FreefireDuo;
use App\Models\FreefireSolo;
use App\Models\FreefireTeam;
use Illuminate\Http\Request;

class AddParticipantController extends Controller
{
    public function index()
    {
        $admin = Admin::all();
        return view('addform', compact('admin'));
    }
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'game' => 'required|string',
            'category' => 'required|string',
            'fullname' => 'required|string|max:255',
            'class' => 'nullable|string|max:255',
            'rollno' => 'nullable|string|max:255',
            'phoneno' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'payment' => 'required|in:upi,cash',
            'transaction' => 'nullable|string|max:255',
            'college' => 'required|string|max:255',
        ]);

        $commonData = [
            'name' => $validated['fullname'],
            'class' => $validated['class'],
            'rollno' => $validated['rollno'],
            'phone_no' => $validated['phoneno'],
            'email' => $validated['email'],
            'pay_mode' => $validated['payment'],
            'transaction_id' => $validated['transaction'] ?? 'CASH',
            'college' => $validated['college'],
            'added_by' => auth()->user()->name ?? 'admin',
            'slot' => 'TBD',
        ];

        /* ---------------- BGMI ---------------- */
        if ($validated['game'] === 'BGMI') {

            if ($validated['category'] === 'Squad') {
                BgmiTeam::create($commonData);
                return redirect()->back()->with('success', 'BGMI Squad registered');
            }

            if ($validated['category'] === 'Duo') {
                BgmiDuo::create($commonData);
                return redirect()->back()->with('success', 'BGMI Duo registered');
            }

            if ($validated['category'] === 'Solo') {
                BgmiSolo::create($commonData);
                return redirect()->back()->with('success', 'BGMI Solo registered');
            }
        }

        /* ---------------- FREE FIRE ---------------- */
        if ($validated['game'] === 'FREE_FIRE') {

            if ($validated['category'] === 'Squad') {
                FreefireTeam::create($commonData);
                return redirect()->back()->with('success', 'Free Fire Squad registered');
            }

            if ($validated['category'] === 'Duo') {
                FreefireDuo::create($commonData);
                return redirect()->back()->with('success', 'Free Fire Duo registered');
            }

            if ($validated['category'] === 'Solo') {
                FreefireSolo::create($commonData);
                return redirect()->back()->with('success', 'Free Fire Solo registered');
            }
        }

        /* ---------------- COD / VALORANT ---------------- */
        if (in_array($validated['game'], ['COD', 'VALORANT'])) {

            if ($validated['category'] === 'Per Team') {
                CodTeam::create($commonData); // if exists
            } else {
                CodSolo::create($commonData); // if exists
            }

            return redirect()->back()->with('success', 'Registration successful');
        }

        /* ---------------- EFOOTBALL / CLASH ROYALE ---------------- */
        if (in_array($validated['game'], ['EFOOTBALL', 'CLASH_ROYALE'])) {
            GameSolo::create($commonData); // generic solo table
            return redirect()->back()->with('success', 'Registration successful');
        }

        return back()->with('error', 'Invalid game or category');
    }

}
