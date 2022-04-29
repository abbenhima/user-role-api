<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_add = Permission::where("name","user_add")->get('id');
        $user_edit = Permission::where("name","user_edit")->get('id');
        $user_show = Permission::where("name","user_show")->get('id');
        $user_delete = Permission::where("name","user_delete")->get('id');
        $permission_add = Permission::where("name","permission_add")->get('id');
        $permission_edit = Permission::where("name","permission_edit")->get('id');
        $permission_show = Permission::where("name","permission_show")->get('id');
        $permission_delete = Permission::where("name","permission_delete")->get('id');
        $role_add = Permission::where("name","role_add")->get('id');
        $role_edit = Permission::where("name","role_edit")->get('id');
        $role_show = Permission::where("name","role_show")->get('id');
        $role_delete = Permission::where("name","role_delete")->get('id');
        $users_by_roles = Permission::where("name","users_by_roles")->get('id');
        $show_user_by_role = Permission::where("name","show_user_by_role")->get('id');

        $role_admin = Role::create(['name'=>'admin']);
        $role_admin->permissions()->attach([$user_add[0]->id,$user_edit[0]->id,$user_show[0]->id,$user_delete[0]->id,$permission_add[0]->id,
        $permission_edit[0]->id,$permission_show[0]->id,$permission_delete[0]->id,$role_add[0]->id,$role_edit[0]->id,$role_show[0]->id,
        $role_delete[0]->id,$users_by_roles[0]->id,$show_user_by_role[0]->id]
        );

        $role_user = Role::create(['name'=>'user']);
        $role_user->permissions()->attach([$role_show[0]->id]);

        $role_user_viewer = Role::create(['name'=>'user_viewer']);
        $role_user_viewer->permissions()->attach([$user_show[0]->id]);
    }
}
