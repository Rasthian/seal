<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class add_default_project extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [ 
            [
                'name' => 'Proyek Alpha',
                'description' => 'Ini adalah deskripsi untuk Proyek Alpha.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Proyek Beta',
                'description' => 'Ini adalah deskripsi untuk Proyek Beta.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Proyek Gamma',
                'description' => 'Ini adalah deskripsi untuk Proyek Gamma.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Proyek Delta',
                'description' => 'Ini adalah deskripsi untuk Proyek Delta.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Proyek Epsilon',
                'description' => 'Ini adalah deskripsi untuk Proyek Epsilon.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach( $projects as $project ){
            $exists = DB::table('projects')->where('name',$project['name'])->count();
            
            if( $exists == 0 ){
                DB::table('project')->insert($project);
                }
        }
    }
}
