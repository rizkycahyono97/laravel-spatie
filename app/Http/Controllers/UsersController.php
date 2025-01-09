<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    // menampilkan semua users
    public function index()
    {
        $users = User::all();

        return view('users.users', compact('users'));
    }

    // create
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'role' => 'required|string'
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role
            ]);
    
            // Assign role user
            $user->assignRole($request->role);
    
            return redirect()->route('users.index')->with('success', 'User Created Success');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // edit 
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'nullable|string',
                'email' => 'nullable|email|max:255|unique:users,email,' . $user->id,
                'role' => 'nullable|string'
            ]);
    
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);
            // sync role user
            $user->syncRoles($request->role);
    
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
       


    }






}
