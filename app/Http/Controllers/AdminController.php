<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($admin) {
            if ($admin->status === 1) {
                session(['id' => $admin->id]);
                session(['username' => $request->username]);
                session(['role' => $admin->role]);
                return redirect('/dashboard');
            } else {
                return redirect()->back()->with('error', 'User Not Active');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    public function form()
    {
        $admin = Admin::all();
        return view('adminform', compact('admin'));
    }

    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'role' => 'required|string|max:255'
        ]);

        Admin::create([
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'role' => $validatedData['role'],
            'status' => 1,
            'online' => 0,
        ]);

        return redirect('/dashboard');
    }

    public function updatestatus(Request $request)
    {
        $userId = $request->id;
        $status = $request->status;
        if ($status) {
            Admin::where('id', $userId)->update(['status' => 0]);
            return redirect()->back()->with('sucess', 'User Inactivated');
        } else {
            Admin::where('id', $userId)->update(['status' => 1]);
            return redirect()->back()->with('sucess', 'User Active');
        }
    }
}
