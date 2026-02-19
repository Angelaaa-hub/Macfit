<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    // Create a new role
    public function createRole(Request $request){
        $validated = $request->validate([
            'name'=>'required|string|unique:roles,name',
            'description'=>'nullable|string|max:1000',
        ]);

        try {
            $role = Role::create($validated);
            return response()->json([
                'success' => true,
                'role' => $role
            ]);
        } catch(\Exception $exception){
            return response()->json([
                'error'=>'Failed to save role',
                'message'=> $exception->getMessage()
            ]);
        }
    }

    // Get all roles
    public function readAllRoles(){
        try{
            $roles = Role::all();
            return response()->json($roles);
        } catch(\Exception $exception){
            return response()->json([
                'error'=> 'Failed to fetch roles',
                'message'=> $exception->getMessage()
            ]);
        }
    }

    // Get a single role
    public function readRole($id){
        try {
            $role = Role::findOrFail($id);
            return response()->json($role);
        } catch(\Exception $exception){
            return response()->json([
                'error'=> 'Failed to fetch the role with ID: '.$id,
                'message'=> $exception->getMessage()
            ]);
        }
    }

    // Update a role
    public function updateRole(Request $request, $id){
        try{
            $validated = $request->validate([
                'name'=>'required|string|unique:roles,name,'.$id,
                'description'=>'nullable|string|max:1000',
            ]);

            $existingRole = Role::findOrFail($id);
            $existingRole->update($validated);

            return response()->json([
                'success' => true,
                'role' => $existingRole
            ]);
        } catch(\Exception $exception){
            return response()->json([
                'error'=> 'Failed to update the role with ID: '.$id,
                'message'=> $exception->getMessage()
            ]);
        }
    }

    // Delete a role
    public function deleteRole($id){
        try{
            $role = Role::findOrFail($id);
            $role->delete();
            return response()->json([
                'success' => true,
                'message' => 'Role deleted successfully'
            ]);
        } catch(\Exception $exception){
            return response()->json([
                'error'=> 'Failed to delete the role',
                'message'=> $exception->getMessage()
            ]);
        }
    }
}
