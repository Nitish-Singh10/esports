<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\BgmiDuo;
use App\Models\BgmiSolo;
use App\Models\BgmiTeam;
use App\Models\ClashRoyal;
use App\Models\CodSolo;
use App\Models\CodTeam;
use App\Models\EFootball;
use App\Models\FCSolo;
use App\Models\FreefireDuo;
use App\Models\FreefireSolo;
use App\Models\FreefireTeam;
use App\Models\Valorant;
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

        /* ---------------- VALORANT ---------------- */
        if ($validated['game'] === 'VALORANT') {
            if ($validated['category'] === 'Solo') {
                Valorant::create($commonData);
                return redirect()->back()->with('success', 'Free Fire Squad registered');
            }
        }

        /* ---------------- EFOOTBALL / CLASH ROYALE ---------------- */
        if ($validated['game'] === 'EFOOTBALL') {
            if ($validated['category'] === 'Solo') {
                EFootball::create($commonData);
                return redirect()->back()->with('success', 'Free Fire Squad registered');
            }
        }
        if ($validated['game'] === 'CLASH_ROYALE') {
            if ($validated['category'] === 'Solo') {
                ClashRoyal::create($commonData);
                return redirect()->back()->with('success', 'Free Fire Squad registered');
            }
        }

        return back()->with('error', 'Invalid game or category');
    }

}
