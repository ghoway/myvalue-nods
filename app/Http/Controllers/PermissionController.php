<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.manage-permission.index', compact('permissions'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
        ]);
        // tambahkan if jika unique maka redirect with 'error'

        $permission = Permission::create($request->all());
        return redirect()->route('permission.index')->with('success', 'Berhasil membuat Permission');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
        ]);
        $permission = Permission::find($id);
        $permission->update($request->all());
        return redirect()->route('permission.index')->with('success', 'Berhasil mengubah Permission');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'Berhasil menghapus Permission');
    }
}
