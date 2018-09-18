<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\App\User::find(1)) {
            factory(\App\User::class)->create([
                'name'     => 'SuperAdmin',
                'email'    => 'admin@nht.com',
                'password' => 'admin'
            ]);
        }

        if (!\App\User::find(2)) {
            factory(\App\User::class)->create([
                'name'     => 'Tuấn Anh',
                'email'    => 'tuananh@nht.com',
                'password' => 'tuananh'
            ]);
        }

        if (!\App\User::find(3)) {
            factory(\App\User::class)->create([
                'name'     => 'Tuấn Em',
                'email'    => 'tuanem@nht.com',
                'password' => 'tuanem'
            ]);
        }

        if (!\App\Repositories\Roles\Role::find(1)) {
            factory(App\Repositories\Roles\Role::class)->create([
                'name' => 'Super admin',
                'slug' => 'superadmin',
                'permissions' => [
                    'admin.super-admin' => true
                ]
            ]);
        }

        if (!DB::table('role_users')->where('user_id', 1)->where('role_id', 1)->first()) {
            DB::table('role_users')->insert(['user_id' => 1, 'role_id' => 1]);
        }

        DB::table('department_user')->insert([
            [
                'user_id' => 1,
                'department_id' => 1,
                'position_id' => 7
            ],

            [
                'user_id' => 1,
                'department_id' => 2,
                'position_id' => 6
            ],
        ]);
    }
}
