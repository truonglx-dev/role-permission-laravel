<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller {
	private $user;
	private $role;

	public function __construct(User $user, Role $role) {
		$this->user = $user;
		$this->role = $role;

	}

	public function index() {
		$listUser = $this->user->all();
		return view('user.index', compact('listUser'));
	}

	public function create() {
		$roles = $this->role->all();
		return view('user.add', compact('roles'));
	}

	public function store(Request $request) {

		$userCreate = $this->user->create([
			'name'     => $request->name,
			'email'    => $request->email,
			'password' => Hash::make($request->password),
			'role_id'  => $request->roles,
		]);
		return redirect()->route('user.index');
	}

	/**
	 * @param $id
	 * show form edit
	 */
	public function edit($id) {
		$roles = $this->role->all();
		$user  = $this->user->findOrfail($id);
		return view('user.edit', compact('roles', 'user'));
	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return mixed
	 */

	public function update(Request $request, $id) {

		$this->user->where('id', $id)->update([
			'name'    => $request->name,
			'email'   => $request->email,
			'role_id' => $request->roles,
		]);
		return redirect()->route('user.index');
	}

	public function delete($id) {
		$user = $this->user->find($id);
		$user->delete($id);
		return redirect()->route('user.index');
	}
}
