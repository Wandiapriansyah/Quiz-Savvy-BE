<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::with('roles')->get();
        return response()->json($users, 200);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'roles_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles_id' => $request->roles_id,
        ]);
        
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function show($id){
        $user = User::with('roles')->find($id);
        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'roles_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'roles_id' => $request->roles_id,
        ]);

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    public function destroy($id){
        $user = User::find($id);
        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
