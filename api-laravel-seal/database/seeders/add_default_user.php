<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class add_default_user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'image' => null,
                'email' => 'john@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), 
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Doe',
                'image' => null,
                'email' => 'jane@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'), 
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            $exists = DB::table('users')->where('email', $user['email'])->count();

            if ($exists == 0) {
                DB::table('users')->insert($user);
            }
        }
    }
}
