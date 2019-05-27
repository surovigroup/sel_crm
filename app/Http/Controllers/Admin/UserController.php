<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', [

            'users' => $users

        ]);
    }

    public function create()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.users.create', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        if($request->roles){
            $user->assignRole($request->roles);
        }

        if($request->permissions){
            $user->givePermissionTo($request->permissions);
        }
        

        Session::flash('message', 'User created Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/users');
    }

    public function edit(User $user)
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if($request->roles){
            $user->syncRoles($request->roles);
        }
        if($request->permissions){
            $user->syncPermissions($request->permissions);
        }
        
        Session::flash('message', 'User updated Successfully!!'); 
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/users');
    }
}
