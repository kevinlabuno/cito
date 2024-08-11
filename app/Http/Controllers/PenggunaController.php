<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pengguna.pengguna',compact('users'));
    }

    public function add_pengguna(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
            'role' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|max:2048',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->phone = $validatedData['phone'] ?? null;
        $user->status = 1;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('assets/picture'), $imageName);
        $user->image = $imageName; // Save only the filename
    }





        $user->save();

        return redirect()->back()->with('success','Pengguna berhasil ditambahkan');
    }

    public function toggleStatus(User $user)
    {
        $user->status = !$user->status;
        $user->save();

        return redirect()->back()->with('success', 'Status pengguna berhasil diubah.');
    }


}
