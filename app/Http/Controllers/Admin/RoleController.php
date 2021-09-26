<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('access-role'), 403);
        $permissions = Permission::latest()->get();
        $roles = Role::with('permissions')->whereNotIn('id', [1])->get(); /* All Role except SuperAdmin*/
        return view('admin.pages.role.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('create-role'), 403);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:190']
        ]);

        $data = $request->except('permission_id');
        $data['slug'] = Str::slug($data['name']);
        $role = Role::create($data);
        $role->permissions()->sync($request->permission_id);

        return redirect('/roles')->with('success', trans('trans.created_successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        abort_unless(Gate::allows('update-role'), 403);

        $this->validate($request, [
            'name' => 'required|string|max:190'
        ]);

        $data = $request->except('permission_id');

        $data['slug'] = Str::slug($request->name);

        $role->update($data);

        if (!empty($request->permission_id)) {
            $role->permissions()->sync($request->permission_id);
        }
        return redirect('/roles')->with('success', trans('trans.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        abort_unless(Gate::allows('delete-role'), 403);
        $role->delete();
        return redirect('/roles')->with('success', trans('trans.deleted_successfully'));
    }
}
