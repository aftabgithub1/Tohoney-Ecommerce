<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleMgmtController extends Controller
{
    public function __construct() {
		$this->middleware(['auth', 'verified', 'role']);
	}


	/**
	 * Index
	 */
	public function rolesAndPermissions() {
		$roles = Role::all();
		$permissions = Permission::all();
		return view('role_mgmt.roles_and_permissions', compact('roles', 'permissions'));
	}

	public function roleHasPermissions() {
		$roles = DB::table('roles')->get();
		$permissions = DB::table('permissions')->get();

		$role_has_permissions = DB::table('role_has_permissions')
		->join('roles', 'role_has_permissions.role_id', 'roles.id')
		->join('permissions', 'role_has_permissions.permission_id', 'permissions.id')
		->select('role_has_permissions.*', 'roles.name as role_name', 'permissions.name as permission_name')
		->get();
		return view('role_mgmt.role_has_permissions', compact('roles', 'permissions', 'role_has_permissions'));
	}

	public function userHasRoles() {
		$users = User::all();
		$roles = Role::all();
		$user_roles = DB::table('model_has_roles')
		->join('users', 'model_has_roles.model_id', 'users.id')
		->join('roles', 'model_has_roles.role_id', 'roles.id')
		->select('users.id as user_id', 'users.name as user_name', 'roles.name as role_name')
		->get();
		return view('role_mgmt.user_has_roles', compact('users', 'roles', 'user_roles'));
	}

	/**
	 * View
	 */
	public function roleHasPermissionsView($role_id) {
		echo $role_id;
		// return view('role_mgmt.roles_and_permissions', compact('roles', 'permissions'));
	}

	public function userHasRolesView($user_id) {
		echo $user_id;
		// return view('role_mgmt.roles_and_permissions', compact('roles', 'permissions'));
	}

	/**
	 * Create
	 */
	public function createRole(Request $request) {
		$request->validate([
			'role_name' => 'required|unique:roles,name'
		]);
		$role = Role::create(['name' => $request->role_name]);
		return back()->with('role_add_success', 'Role added successfully!')->withErrors('role');
	}

	public function createPermission(Request $request) {
		$request->validate([
			'permission_name' => 'required|unique:permissions,name'
		]);
		$permission = Permission::create(['name' => $request->permission_name]);
		return back()->with('permission_add_success', 'Permission added successfully!')->withErrors('permission');
	}


	public function roleHasPermissionsStore(Request $request) {
		$request->validate([
			'role_id' => 'required',
			'permission_ids' => 'required'
		]);
		foreach($request->permission_ids as $request->permission_id) {
			Role::find($request->role_id)->givePermissionto($request->permission_id);
		}
		return back()->with('assign_permission_success', 'Permission assignd to role successfully!');
	}

	public function userHasRolesStore(Request $request) {
		$request->validate([
			'user_id' => 'required',
			'role_id' => 'required'
		]);
		$user = User::find($request->user_id);
		$user->assignRole($request->role_id);
		$user->update(['role' => 1]);
		return back()->with('assign_role_to_user_success', 'Role assignd successfully!');
	}


	/**
	 * Edit
	 */
	public function userHasRolesEdit($user_id) { 
		$user = User::find($user_id);
		$roles = Role::all();
		$model_has_roles = DB::table('model_has_roles')
			->where('model_id', $user_id)
			->join('roles', 'model_has_roles.role_id', 'roles.id')
			->select('model_has_roles.role_id', 'roles.name as role_name')
			->first();
		return view('role_mgmt.user_has_roles_edit', compact('user', 'roles', 'model_has_roles'));
	}


	/**
	 * Update
	 */
	public function userHasRolesUpdate(Request $request) {
		DB::table('model_has_roles')->where('model_id', $request->user_id)->update(['role_id' => $request->role_id]);
		return back()->with('role_update_success', 'Role updated successfully!');
	}


	/**
	 * DELETE
	 */
	public function deleteRole($role_id) {
		Role::find($role_id)->delete();
		return back()->with('delete_role_success', 'Role deleted successfully!');
	}
	
	public function deletePermission($permission_id) {
		Permission::find($permission_id)->delete();
		return back()->with('delete_permission_success', 'Permission deleted successfully!');

	}

	public function roleHasPermissionDelete($role_id) {
		$role_has_permissions = DB::table('role_has_permissions')->where('role_id', $role_id)->delete();
		return back()->with('delete_permission_to_role_success', 'Permission to role deleted successfully!');
	}
	
	public function userHasRolesDelete($user_id) {
		$model_has_roles = DB::table('model_has_roles')->where('model_id', $user_id)->delete();
		return back()->with('delete_user_role_success', 'User role deleted successfully!');
	}

}
