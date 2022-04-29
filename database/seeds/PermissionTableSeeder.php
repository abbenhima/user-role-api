<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(["name"=>"user_add"]);
        Permission::create(["name"=>"user_edit"]);
        Permission::create(["name"=>"user_show"]);
        Permission::create(["name"=>"user_delete"]);
        Permission::create(["name"=>"permission_add"]);
        Permission::create(["name"=>"permission_edit"]);
        Permission::create(["name"=>"permission_show"]);
        Permission::create(["name"=>"permission_delete"]);
        Permission::create(["name"=>"role_add"]);
        Permission::create(["name"=>"role_edit"]);
        Permission::create(["name"=>"role_show"]);
        Permission::create(["name"=>"role_delete"]);
        Permission::create(["name"=>"users_by_roles"]);
        Permission::create(["name"=>"show_user_by_role"]);

    }
}
