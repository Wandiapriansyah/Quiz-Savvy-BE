<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Roles::all();
        return response()->json($roles, 200);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|unique:roles|max:255',
        ]);

        $roles = Roles::create([
            'nama' => $request->nama,
        ]);

        return response()->json(['message' => 'Roles Created Successfully', 'roles' => $roles], 201);
    }

    public function show($id){
        $roles = Roles::find($id);
        if (!$roles) {
            return response()->json(['message' => 'Role snot found'], 404);
        }

        return response()->json($roles, 200);
    }

    public function update(Request $request, $id){
        $roles = Roles::find($id);
        if(!$roles) {
            return response()->json(['message' => 'Roles not found'], 404);
        }

        $request->validate([
            'nama' => 'required|string|unique:roles,nama,' . $id . '|max:255',
        ]);

        $roles->update([
            'nama' => $request->nama,
        ]);
        
        return response()->json(['message' => 'Roles updated successfully', 'roles' => $roles], 200);
    }

    public function destroy($id){
        $roles = Roles::find($id);
        if(!$roles) {
            return response()->json(['message' => 'Roles not found'], 404);
        }

        $roles->delete();
        return response()->json(['message' => 'Roles deleted successfully'], 200);
    }
}
