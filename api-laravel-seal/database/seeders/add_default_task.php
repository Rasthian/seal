<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class add_default_task extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                'name' => 'Tugas 1',
                'description' => 'Deskripsi untuk Tugas 1.',
                'status' => 'pending',
                'project_id' => 1, 
                'user_id' => 1,    
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tugas 2',
                'description' => 'Deskripsi untuk Tugas 2.',
                'status' => 'in progress',
                'project_id' => 1, 
                'user_id' => 2,    
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tugas 3',
                'description' => 'Deskripsi untuk Tugas 3.',
                'status' => 'completed',
                'project_id' => 2, 
                'user_id' => 1,    
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tugas 4',
                'description' => 'Deskripsi untuk Tugas 4.',
                'status' => 'pending',
                'project_id' => 2, 
                'user_id' => 3,    
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tugas 5',
                'description' => 'Deskripsi untuk Tugas 5.',
                'status' => 'in progress',
                'project_id' => 3, 
                'user_id' => 2,    
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ( $tasks as $task) {
            $exist = DB::table('tasks')->where('name', $task['name'])->count();
            
            if ($exist == 0) {
                DB::table('tasks')->insert($task);
            }
        }
    }
}
        