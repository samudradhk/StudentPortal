<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            ['name' => 'Linear Algebra', 'code' => 'COMP1122'],
            ['name' => 'Introduction to Algorithm', 'code' => 'COMP3344'],
            ['name' => 'Web Programming', 'code' => 'COMP5566'],
        ]);
    }
}
