<?php

namespace App\Http\Controllers\Api;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    //
    public function Permission()
    {
    	$user_permission = Permission::where('slug','user_role')->first();
		$admin_permission = Permission::where('slug', 'admin_role')->first();

		//RoleTableSeeder.php
		$user_role = new Role();
		$user_role->slug = 'user';
		$user_role->name = 'User_Name';
		$user_role->save();
		$user_role->permissions()->attach($user_permission);

		$admin_role = new Role();
		$admin_role->slug = 'admin';
		$admin_role->name = 'Admin_Name';
		$admin_role->save();
		$admin_role->permissions()->attach($admin_permission);

		$user_role = Role::where('slug','user')->first();
		$admin_role = Role::where('slug', 'admin')->first();

		$userTasks = new Permission();
		$userTasks->slug = 'user-tasks';
		$userTasks->name = 'User Tasks';
		$userTasks->save();
		$userTasks->roles()->attach($user_role);

		$adminTasks = new Permission();
		$adminTasks->slug = 'admin-tasks';
		$adminTasks->name = 'Admin Tasks';
		$adminTasks->save();
		$adminTasks->roles()->attach($admin_role);

		$user_role = Role::where('slug','user')->first();
		$admin_role = Role::where('slug', 'admin')->first();
		$user_perm = Permission::where('slug','user-tasks')->first();
		$admin_perm = Permission::where('slug','admin-tasks')->first();

		$user = new User();

		$user->email = 'user1@gmail.com';
		$user->password = bcrypt('12345678');
		$user->save();
		$user->roles()->attach($user_role);
		$user->permissions()->attach($user_perm);

		$admin = new User();

		$admin->email = 'admin1@gmail.com';
		$admin->password = bcrypt('12345678');
		$admin->save();
		$admin->roles()->attach($admin_role);
		$admin->permissions()->attach($admin_perm);


    }

}
