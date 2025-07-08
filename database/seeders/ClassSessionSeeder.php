<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSession;
use App\Models\Course;
use App\Models\Program;
use Illuminate\Support\Arr;

class ClassSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data to avoid duplicates
        ClassSession::query()->delete();

        $itProgram = Program::where('code', 'IT')->first();

        if (!$itProgram) {
            $this->command->warn('IT Program not found, skipping ClassSessionSeeder.');
            return;
        }

        $this->command->info('Seeding schedules for IT Program, Year 1, Promotion 33...');

        // --- Define Base Data ---
        $lecturers = ['Dr. Alan Turing', 'Prof. Ada Lovelace', 'Mr. Tim Berners-Lee', 'Ms. Grace Hopper', 'Dr. John von Neumann'];
        $rooms = ['A101', 'A102', 'B201', 'B202', 'C301'];
        $weekday_days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        
        // --- Get Courses for Year 1, Semester 1 ---
        $courses_sem1 = Course::where('program_id', $itProgram->id)
            ->where('year', 1)
            ->where('semester', 1)
            ->get();

        if ($courses_sem1->count() < 5) {
            $this->command->error('Not enough courses found for Year 1, Semester 1 to generate a full schedule. Please seed courses first.');
            return;
        }

        // --- Generate Schedule for Weekday Group (Group 13 - Morning) ---
        $this->command->info('Generating schedule for Weekday Group 13 (Morning Shift)...');
        foreach ($weekday_days as $index => $day) {
            ClassSession::create([
                'course_id' => $courses_sem1[$index]->id,
                'program_id' => $itProgram->id,
                'promotion_name' => '33',
                'group_name' => '13',
                'year' => 1,
                'semester' => 1,
                'day_of_week' => $day,
                'start_time' => '07:00:00',
                'end_time' => '11:00:00',
                'shift' => 'Morning',
                'lecturer_name' => Arr::random($lecturers),
                'room_number' => Arr::random($rooms),
            ]);
        }

        // --- Generate Schedule for Weekday Group (Group 39 - Afternoon) ---
        $this->command->info('Generating schedule for Weekday Group 39 (Afternoon Shift)...');
        // Shuffle courses for variety
        $shuffled_courses = $courses_sem1->shuffle();
        foreach ($weekday_days as $index => $day) {
            ClassSession::create([
                'course_id' => $shuffled_courses[$index]->id,
                'program_id' => $itProgram->id,
                'promotion_name' => '33',
                'group_name' => '39',
                'year' => 1,
                'semester' => 1,
                'day_of_week' => $day,
                'start_time' => '13:00:00',
                'end_time' => '17:00:00',
                'shift' => 'Afternoon',
                'lecturer_name' => Arr::random($lecturers),
                'room_number' => Arr::random($rooms),
            ]);
        }
        
        $this->command->info('Class session seeding for Promotion 33 complete.');
    }
}
