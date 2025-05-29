<?php

namespace App\Http\Controllers\Spatie;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function Show()
    {
        return view('admin.Spatie.role');
    }
    // //////////////////////////////////////////Store
// /////////////////////////////////////////////Role has Permission////////
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            "name" => "required|unique:roles,name",
            "permissions" => "required|array"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ],422);
        }

        $validated = $validator->validated();

        try {
            $role = Role::create(['name' => $validated['name']]);

            if (!empty($validated['permissions'])) {
                $role->syncPermissions($validated['permissions']);
            }
        
            return response()->json([
                'status' => true,
                'message' => "Role and Permissions inserted successfully",
                'role' => $role,
                'permissions_assigned' => $role->permissions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }




    // ///////////////////////////////////
    public function viewRole()


    {
        $role = Role::all();
        return view('admin.Spatie.index', compact('role'));
    }
    // ///////////////////////////////////
    public function ShowPermission()
    {
        return view('admin.Spatie.permission');
    }
    // ////////////////////////////////
    public function storePermission(Request $request)
    {
        Permission::create([
            'name' => $request->name,
        ]);
        session()->flash('success_msg', 'Permission inserted successfully');
        return redirect()->route('admin.viewpermission')->with('success', 'Permission Added Successfully');
    }

    // /////////////////////////////////
    public function viewPermission()

    {

        $permission = Permission::all();
        return view('admin.Spatie.view_permission', compact('permission'));
    }
}
