<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Command\ListCommand\FunctionEnumerator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.manage-role.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'permissions' => 'required|array', // Validasi untuk memastikan bahwa permissions di-submit
            'permissions.*' => 'exists:permissions,name' // Pastikan setiap permission yang di-submit ada di database
        ]);

        $role = Role::create(['name' => $request->input('name')]); // Membuat role dengan nama yang diberikan

        // Menetapkan permissions ke role
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions); // Metode syncPermissions dari Spatie untuk menetapkan permissions

        return redirect()->route('role.index')->with('success', 'Berhasil membuat Role dengan Permissions.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name'
        ]);

        $role = Role::find($id);
        $role->update(['name' => $request->input('name')]);

        // Menetapkan permissions ke role
        $permissions = $request->input('permissions', []);
        $role->syncPermissions($permissions); // Metode syncPermissions dari Spatie untuk menetapkan permissions

        return redirect()->route('role.index')->with('success', 'Berhasil mengubah Role dengan Permissions.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Berhasil menghapus Role.');
    }
}
