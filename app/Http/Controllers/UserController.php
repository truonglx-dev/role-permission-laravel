<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Hash;
use DB;

class UserController extends Controller
{
    private $user;
    private $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;

    }

    public function index()
    {
        $listUser = $this->user->all();
        return view('user.index', compact('listUser'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // Insert data to user table
            $userCreate = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            // Insert data to role_user
            $userCreate->roles()->attach($request->roles);
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }


    }

    /**
     * @param $id
     * show form edit
     */
    public function edit($id)
    {
        $roles = $this->role->all();
        $user = $this->user->findOrfail($id);
        $listRoleOfUser = DB::table('role_user')->where('user_id', $id)->pluck('role_id');
        return view('user.edit', compact('roles', 'user', 'listRoleOfUser'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            // update user tabale
            $this->user->where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            // Update to role_user table
            DB::table('role_user')->where('user_id', $id)->delete();
            $userCreate = $this->user->find($id);
            $userCreate->roles()->attach($request->roles);
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }


    }


    public function delete($id)
    {
        try {
            DB::beginTransaction();
            // Delete user
            $user = $this->user->find($id);
            $user->delete($id);
            // Delete user of role_user table
            $user->roles()->detach();
            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }
}
