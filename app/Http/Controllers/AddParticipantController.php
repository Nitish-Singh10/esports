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
        $validatedData = $request->validate([
            'game' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'class' => 'nullable|string|max:255',
            'rollno' => 'required|string|max:255',
            'phoneno' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'payment' => 'required|string|max:255',
            'transaction' => 'nullable|string|max:255',
        ]);

        if ($validatedData['game'] === "BGMI") {
            if ($validatedData['type'] === "Team") {
                BgmiTeam::create([
                    'name' => $validatedData['fullname'],
                    'class' => $validatedData['class'],
                    'rollno' => $validatedData['rollno'],
                    'phone_no' => $validatedData['phoneno'],
                    'email' => $validatedData['email'],
                    'pay_mode' => $validatedData['payment'],
                    'transaction_id' => $validatedData['transaction'],
                ]);
                return redirect('/dashboard');
            } elseif ($validatedData['type'] === "Duo") {
                BgmiDuo::create([
                    'name' => $validatedData['fullname'],
                    'class' => $validatedData['class'],
                    'rollno' => $validatedData['rollno'],
                    'phone_no' => $validatedData['phoneno'],
                    'email' => $validatedData['email'],
                    'pay_mode' => $validatedData['payment'],
                    'transaction_id' => $validatedData['transaction'],
                ]);
                return redirect('/bgmi_duo');
            } elseif ($validatedData['type'] === "Solo") {
                BgmiSolo::create([
                    'name' => $validatedData['fullname'],
                    'class' => $validatedData['class'],
                    'rollno' => $validatedData['rollno'],
                    'phone_no' => $validatedData['phoneno'],
                    'email' => $validatedData['email'],
                    'pay_mode' => $validatedData['payment'],
                    'transaction_id' => $validatedData['transaction'],
                ]);
                return redirect('/bgmi_solo');
            }
        } elseif ($validatedData['game'] === "FREEFIRE") {
            if ($validatedData['type'] === "Team") {
                FreefireTeam::create([
                    'name' => $validatedData['fullname'],
                    'class' => $validatedData['class'],
                    'rollno' => $validatedData['rollno'],
                    'phone_no' => $validatedData['phoneno'],
                    'email' => $validatedData['email'],
                    'pay_mode' => $validatedData['payment'],
                    'transaction_id' => $validatedData['transaction'],
                ]);
                return redirect('/freefire_team');
            } elseif ($validatedData['type'] === "Duo") {
                FreefireDuo::create([
                    'name' => $validatedData['fullname'],
                    'class' => $validatedData['class'],
                    'rollno' => $validatedData['rollno'],
                    'phone_no' => $validatedData['phoneno'],
                    'email' => $validatedData['email'],
                    'pay_mode' => $validatedData['payment'],
                    'transaction_id' => $validatedData['transaction'],
                ]);
                return redirect('/freefire_duo');
            } elseif ($validatedData['type'] === "Solo") {
                FreefireSolo::create([
                    'name' => $validatedData['fullname'],
                    'class' => $validatedData['class'],
                    'rollno' => $validatedData['rollno'],
                    'phone_no' => $validatedData['phoneno'],
                    'email' => $validatedData['email'],
                    'pay_mode' => $validatedData['payment'],
                    'transaction_id' => $validatedData['transaction'],
                ]);
                return redirect('/freefire_solo');
            }
        } elseif ($validatedData['game'] === "FC") {
            FCSolo::create([
                'name' => $validatedData['fullname'],
                'class' => $validatedData['class'],
                'rollno' => $validatedData['rollno'],
                'phone_no' => $validatedData['phoneno'],
                'email' => $validatedData['email'],
                'pay_mode' => $validatedData['payment'],
                'transaction_id' => $validatedData['transaction'],
            ]);
            return redirect('/fcmobile');
        }
    }
}
