<?php

namespace App\Http\Middleware;

use App\Permission;
use App\Role;
use App\User;
use Closure;
use DB;

class CheckPermissionAcl {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $permission = null) {
		// get role user
		$role_user = User::find(auth()->id())->role_id;
		// check role user == admin
		if ($role_user == 1) {
			return $next($request);
		}
		// check role user != admin
		$listPermissionOfUser = DB::table('roles')
			->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
			->join('permissions', 'permission_role.permission_id', '=', 'permissions.id')
			->where('roles.id', $role_user)
			->select('permissions.*')
			->get()->pluck('id')->unique();

		// get id permission of the parameter
		$checkPermission = Permission::where('name', $permission)->value('id');
		// check id permission of the parameter exits listPermissionOfUser
		if ($listPermissionOfUser->contains($checkPermission)) {
			return $next($request);
		}
		return abort(401);
	}
}
