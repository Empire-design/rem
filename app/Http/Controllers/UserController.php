<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\User;
use Illuminate\Http\Request;
use function Pest\Laravel\json;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function viewUsers()
    {
        if (Gate::allows('is_admin')) {
            $users = User::all();
            return view('admin.user.viewUser', compact('users'));
        } else {
            return view('admin.dashboard');
        }
    }
    public function Home()
    {
        return view('user.home');
    }
    // ///////////////////////////////Show Model has Role form//////////////
    public function userShow()
    {
        if (Gate::allows('is_admin')) {

            return view('admin.user.model_has_Role');
        } else {
            return view('admin.dashboard');
        }
    }
    // ///////////////////////////////Show Model has Permission form//////////////
    public function modelHasPermission()
    {
        if (Gate::allows('is_admin')) {

            return view('admin.user.model _has_permission');
        } else {
            return view('admin.dashboard');
        }
    }
    /////////////////////////////////Add Model has Permission assigned/////////
    public function storePermission(Request $request)
    {
        if (Gate::allows('is_admin')) {

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
        } else {
            return view('admin.dashboard');
        }
    }

    // /////////////////////////////Add Model has Role assigned ////////////

    public function Store(Request $request)
    {
        if (Gate::allows('is_admin')) {

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
        } else {
            return view('admin.dashboard');
        }
    }

    public function viewUser()
    {
        if (Gate::allows('is_admin')) {

            $user = User::all();
            return view('admin.user.viewUser', compact('user'));
        } else {
            return view('admin.dashboard');
        }
    }
}
