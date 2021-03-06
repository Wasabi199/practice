<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Admin, Contributions, Loans};
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            User::factory(50)->has(Loans::factory(),'loans')->create();
        // User::factory(10)->has(Admin::factory(),'adminReg')->create();
            $admin = User::create([
                'name' => "Super Admin",
                'usertype' => 1,
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]);
            $admin ->adminReg()->create(Admin::factory(['user_id' => $admin->id])->make()->toArray());
            $user = User::create([
                'name' => "Normal User",
                'usertype' => 2,
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
            ]);
            $user ->adminReg()->create(Admin::factory(['user_id' => $user->id])->make()->toArray());
            

    }
}
