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
                'name'          => 'SuperAdmin',
                'email'         => 'admin@nht.com',
                'password'      => 'admin',
                'qualification' => null,
                'address'       => null,
                'phone'         => null,
                'gender'        => 2,
                'date_of_birth' => null,
                'avatar'        => null,
                'status'        => 1
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

        factory(\App\User::class, 100)->create()->each(function($user) {
            $user->departments()->sync([rand(1, 6) => ['position_id' => rand(5, 7)]]);
            for($i = 0; $i <= rand(1, 3); $i++) {
                $user->contracts()->save(factory(App\Repositories\Contracts\Contract::class)->make());
            }
        });

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
    }
}
