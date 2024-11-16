<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('role')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'User', 'Create')) {
            abort(403, 'Unauthorized action.');
        }
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'username' => 'required|string|max:255',
                'is_active' => 'required|boolean',
                'role_id' => 'required|exists:roles,id',
                'gender' => 'required',
                'address' => 'required',
                'phone' => 'required',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'username' => $request->username,
                'address' => $request->address,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'is_active' => $request->is_active,
                'role_id' => $request->role_id,
            ]);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['danger' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'User', 'Update')) {
            abort(403, 'Unauthorized action.');
        }
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'username' => 'required|string|max:255',
                'is_active' => 'required|boolean',
                'role_id' => 'required|exists:roles,id',
            ]);

            $user = User::findOrFail($id);

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address,
                'role_id' => $request->role_id,
                'is_active' => $request->is_active,
            ]);
            DB::commit();

            return redirect()->route('users.index')->with('warning', 'User updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['danger' => 'There was an error: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.index')->with('danger', 'User deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['danger' => 'Error deleting user: ' . $e->getMessage()]);
        }
    }
}
