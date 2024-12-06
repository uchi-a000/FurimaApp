<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(ConditionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);

        //管理者
        $admin_role = Role::create(['name' => 'admin']);

        //権限
        $manage_user_permission = Permission::create(['name' => 'delete users']);
        $manage_comment_permission = Permission::create(['name' => 'delete comments']);

        //役割に権限を付与
        $admin_role->givePermissionTo($manage_user_permission, $manage_comment_permission);

        $admin_user = User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => bcrypt('pppp0000'),
            'email_verified_at' => now()
        ]);

        $admin_user->assignRole('admin');
    }
}
