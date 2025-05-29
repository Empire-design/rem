<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function Home()
    {
        return view('user.home');
    }
    // ///////////////////////////////Show Model has Role form//////////////
    public function userShow()
    {
        return view('admin.user.model_has_Role');
    }
    // ///////////////////////////////Show Model has Permission form//////////////
    public function modelHasPermission()
    {
        return view('admin.user.model _has_permission');
    }
    /////////////////////////////////Add Model has Permission assigned/////////
    public function storePermission(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'permissions.*' => 'required|exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->usertype = 'user';
            $user->password = Hash::make($request->password);
            $user->save();

            $validated = $validator->validated();

            if (!empty($validated['permissions'])) {
                $user->givePermissionTo($validated['permissions']);
            }

            return response()->json([
                'status' => true,
                'message' => 'User and permissions inserted successfully',
                'user' => $user,
                'roles' => $user->permissions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    // /////////////////////////////Add Model has Role assigned ////////////

    public function Store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            "roles" => "required|exists:roles,name"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->usertype = 'user';
            $user->password = Hash::make($request->password);
            $user->save();

            $validated = $validator->validated();

            if (!empty($validated['roles'])) {
                $user->syncRoles($validated['roles']);
            }
            return response()->json([
                'status' => true,
                'message' => 'User and role inserted successfully',
                'user' => $user,
                'roles' => $user->roles
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    public function viewUser()
    {
        $user = User::all();
        return view('admin.user.viewUser', compact('user'));
    }
}
