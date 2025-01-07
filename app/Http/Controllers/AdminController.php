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
            session(['username' => $request->username]);
            session(['role' => $admin->role]);
            return redirect('/dashboard');
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
            'role' => $validatedData['role']
        ]);

        return redirect('/dashboard');
    }
}
