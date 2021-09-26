<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->whereNotIn('id', [1])->get(); /* All User except Super Admin */
        $roles = Role::whereNotIn('id', [1])->get(); /* All Role except SuperAdmin*/
        return view('admin.pages.users.index',compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('create-user'), 403);
        $request->validate([
            'name' => 'required|max:190',
            'email' => 'required|email|unique:users',
            'password'=> 'required',
        ]);
        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->back()->with('success', 'User Create Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_unless(Gate::allows('update-user'), 403);
        $request->validate([
            'name' => 'required|max:190',
            'email' => 'required|email',
        ]);

        $data = $request->except(['_token']);

        $user->update($data);

        return redirect()->back()->with('success', 'User update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_unless(Gate::allows('delete-user'), 403);
        $user->delete();
        return redirect()->back()->with('success', 'User Delete successfully');

    }

    public function assignRole(Request $request, User $user)
    {
        abort_unless(Gate::allows('update-role'), 403);

        $request->validate([
            'role_id'=>'required'
        ]);
        $user->roles()->sync($request->role_id);

        return redirect()->back()->with('success', "Assign Role Successfully");

    }
}
