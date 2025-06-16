<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Program::create([
            'name' => 'Information Technology',
            'code' => 'IT',
            'description' => 'Focuses on software development, network systems, and cybersecurity.'
        ]);

        Program::create([
            'name' => 'Business Information Technology',
            'code' => 'BIT',
            'description' => 'Merges technology with business acumen to solve complex business challenges.'
        ]);

        Program::create([
            'name' => 'Robotic Engineering',
            'code' => 'Robotic',
            'description' => 'Design, build, and program intelligent systems and automation.'
        ]);
    }
}