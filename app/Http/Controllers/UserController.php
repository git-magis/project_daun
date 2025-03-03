<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.manage_user', compact('users')); // Assuming you have a dashboard view
    }

    public function store(Request $request) 
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'level' => 'required|in:admin,staff',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);

        return redirect()->route('manage-user')->with('success', 'Staff berhasil ditambahkan!');
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $data = User::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('manage-user')->with('success', 'berhasil');
    }

    public function destroy($id)
    {
        // Find the tree by ID and delete it
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->route('manage-user')->with('success', 'Data deleted sucessfully.');
    }
}
