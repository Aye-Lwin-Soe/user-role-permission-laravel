<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Feature;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        if (!\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'Role', 'Create')) {
            abort(403, 'Unauthorized action.');
        }

        $feature_permissions = Feature::with('permissions')->get();
        return view('roles.create', compact('feature_permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|string',
                'permissions' => 'sometimes|array',
            ]);

            $role = Role::create([
                'name' => $request->name,
            ]);

            if ($request->has('permissions')) {
                $permissions = collect($request->permissions)->flatten()->unique()->toArray();
                $role->permissions()->sync($permissions);
            }
            DB::commit();
            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['danger' => 'There was an error: ' . $e->getMessage()]);
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
    public function edit(string $id)
    {
        //
        if (!\App\Helpers\PermissionHelper::userCanAccessFeature(auth()->user(), 'Role', 'Update')) {
            abort(403, 'Unauthorized action.');
        }
        $role = Role::with('permissions')->findOrFail($id);
        $feature_permissions = Feature::with('permissions')->get();
        return view('roles.edit', compact('role', 'feature_permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|string',
                'permissions' => 'sometimes|array',
            ]);

            $role = Role::findOrFail($id);
            $role->update([
                'name' => $request->name,
            ]);

            if ($request->has('permissions') && !empty($request->permissions)) {
                $permissions = collect($request->permissions)->flatten()->unique()->toArray();
                $role->permissions()->sync($permissions);
            } else {
                $role->permissions()->detach();
            }
            DB::commit();
            return redirect()->route('roles.index')->with('warning', 'Role updated successfully');
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
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->permissions()->detach();
            $role->delete();
            DB::commit();
            return redirect()->route('roles.index')->with('danger', 'Role deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['danger' => 'There was an error: ' . $e->getMessage()]);
        }
    }
}
