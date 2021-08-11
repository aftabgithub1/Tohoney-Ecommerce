<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleMgmtController extends Controller
{
    public function __construct() {
		$this->middleware(['auth', 'verified', 'role']);
	}

	public function addRoleAndPermission() {
		$roles = Role::all();
		$permissions = Permission::all();
		return view('role_mgmt.add_role_and_permission', compact('roles', 'permissions'));
	}

	public function roleCreate(Request $request) {
		$request->validate([
			'role_name' => 'required|unique:roles,name'
		]);
		$role = Role::create(['name' => $request->role_name]);
		return back()->with('role_add_success', 'Role added successfully!')->withErrors('role');
	}

	public function permissionCreate(Request $request) {
		$request->validate([
			'permission_name' => 'required|unique:permissions,name'
		]);
		$permission = Permission::create(['name' => $request->permission_name]);
		return back()->with('permission_add_success', 'Permission added successfully!')->withErrors('permission');
	}

	public function addUserRole(Request $request) {
		echo "User role added";
	}

}
