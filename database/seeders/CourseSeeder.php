<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->delete();

        // --- Information Technology (IT) Program ---
        $itProgram = Program::where('code', 'IT')->first();
        if ($itProgram) {
            $itCourses = [
                // Year 1
                ['name' => 'Python Programming 1', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Networking Essentials 1 (CISCO-ITE)', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Mathematics 1', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Introduction to Computer Science', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Critical thinking', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Python Programming 2', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Networking Essentials 2 (CISCO-ITE)', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Mathematics 2', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Architecture and Operating System', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Design Thinking', 'year' => 1, 'semester' => 2, 'description' => ''],

                // Year 2
                ['name' => 'Algorithms and Data Structures I', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Object Oriented Programming I (Mobile App I)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Network Administration I (CISCO CCNA)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Database & Advanced data techniques (MySQL)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Statistics and Probability', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Algorithms and Data Structures II', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Object Oriented Programming II (Mobile App II)', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Network Administration II (CISCO CCNA)', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Static Web Development (HTML, CSS & JavaScript)', 'year' => 2, 'semester' => 2, 'description' => ''],

                // Year 3
                ['name' => 'Introduction to Data Science', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'IoT Project I', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Network Administration III (CISCO CCNA)', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Fundamentals of Cybersecurity', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'ASP.NET Web App Development with C#-I', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Data Science and Artificial Intelligence', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Research Project II', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Linux Administration I', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Ethical Hacking', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'ASP.NET Web App Development with C#-II', 'year' => 3, 'semester' => 2, 'description' => ''],

                // Year 4
                ['name' => 'Computer Vision and Machine Learning', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Business Startup', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Linux Administration II', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => '*Internship (optional course) / CICSO / AWS', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Research seminar', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Seminar \ Workshop', 'year' => 4, 'semester' => 2, 'description' => ''],
                ['name' => 'Project Completion & Thesis Writing', 'year' => 4, 'semester' => 2, 'description' => ''],
            ];

            foreach ($itCourses as $courseData) {
                Course::create(array_merge($courseData, ['program_id' => $itProgram->id]));
            }
        }
        
        // --- Business Information Technology (BIT) Program ---
        $bitProgram = Program::where('code', 'BIT')->first();
        if ($bitProgram) {
            $bitCourses = [
                // Year 1
                ['name' => 'Python Programming 1', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Networking Essentials 1 (CISCO-ITE)', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Mathematics 1', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Introduction to Computer Science', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Critical thinking', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Python Programming 2', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Networking Essentials 2 (CISCO-ITE)', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Mathematics 2', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Architecture and Operating System', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Design Thinking', 'year' => 1, 'semester' => 2, 'description' => ''],

                // Year 2
                ['name' => 'Algorithms and Data Structures I', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Object Oriented Programming I (Mobile App I)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Network Administration I (CISCO CCNA)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Database & Advanced data techniques (MySQL)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Statistics and Probability', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Algorithms and Data Structures II', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Object Oriented Programming II (Mobile App II)', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Network Administration II (CISCO CCNA)', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Static Web Development (HTML, CSS & JavaScript)', 'year' => 2, 'semester' => 2, 'description' => ''],

                // Year 3
                ['name' => 'Introduction to Data Science', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'IOT Project', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Network Administration III (CISCO CCNA)', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Linux Administration I', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'ASP.NET Web App Development with C#-I', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Data Science and Artificial Intelligence', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Research Project', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Fundamentals of Cybersecurity', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Linux Administration II', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'ASP.NET Web App Development with C#-II', 'year' => 3, 'semester' => 2, 'description' => ''],

                // Year 4
                ['name' => 'Computer Vision and Machine Learning', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Business Startup', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'AWS Cloud Computing for Developer', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Ethical Hacking', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Research Methodology', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Project Completion & Thesis Writing', 'year' => 4, 'semester' => 2, 'description' => ''],
            ];

            foreach ($bitCourses as $courseData) {
                Course::create(array_merge($courseData, ['program_id' => $bitProgram->id]));
            }
        }

        // --- Robotic Engineering Program ---
        $roboticProgram = Program::where('code', 'Robotic')->first();
        if ($roboticProgram) {
            $roboticCourses = [
                // Year 1
                ['name' => 'Python Programming 1', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Networking Essentials 1 (CISCO-ITE)', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Mathematics 1', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Introduction to Computer Science', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Critical thinking', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Python Programming 2', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Networking Essentials 2 (CISCO-ITE)', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Mathematics 2', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Architecture and Operating System', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Design Thinking', 'year' => 1, 'semester' => 2, 'description' => ''],

                // Year 2
                ['name' => 'Algorithms and Data Structures I', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Object Oriented Programming I (Mobile App I)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Network Administration I (CISCO CCNA)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Database & Advanced data techniques (MySQL)', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Statistics and Probability', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Algorithms and Data Structures II', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Object Oriented Programming II (Mobile App II)', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Network Administration II (CISCO CCNA)', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Static Web Development (HTML, CSS & JavaScript)', 'year' => 2, 'semester' => 2, 'description' => ''],

                // Year 3
                ['name' => 'MATLAB', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Power Electronics I (POE-I)', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'IoT Project I', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'CAD Design', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Circuits Design', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Control Systems (CON-I)', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Power Electronics II (POE-II)', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Research Project II', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Programming Logic Control(PLC)', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Robot Operating System (ROS) I', 'year' => 3, 'semester' => 2, 'description' => ''],

                // Year 4
                ['name' => 'Robotics Programming with ROS II', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Advanced Simulation Software', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Control Systems (CON-II)', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Computer Vision for Robotics', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Research Methodology (Project Proposal)', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Project Completion & Thesis Writing', 'year' => 4, 'semester' => 2, 'description' => ''],
            ];
            
            foreach ($roboticCourses as $courseData) {
                Course::create(array_merge($courseData, ['program_id' => $roboticProgram->id]));
            }
        }
        
        // --- Computer Science (CS) Program ---
        $csProgram = Program::where('code', 'CS')->first();
        if ($csProgram) {
            $csCourses = [
                // Year 1
                ['name' => 'English Communication', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Calculus I', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Introduction to Computer Science and Programming', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Digital Logic and Computer Architecture', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Introduction to Web Development', 'year' => 1, 'semester' => 1, 'description' => ''],
                ['name' => 'Academic Writing', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Discrete Mathematics', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Object-Oriented Programming', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Data Structures and Algorithms', 'year' => 1, 'semester' => 2, 'description' => ''],
                ['name' => 'Networking Fundamentals', 'year' => 1, 'semester' => 2, 'description' => ''],

                // Year 2
                ['name' => 'Database Systems', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Operating Systems', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Computer Networks', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Web Application Development', 'year' => 2, 'semester' => 1, 'description' => ''],
                ['name' => 'Mobile Application Development', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Introduction to Artificial Intelligence', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Cybersecurity Principles', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Cloud Computing', 'year' => 2, 'semester' => 2, 'description' => ''],
                ['name' => 'Human-Computer Interaction', 'year' => 2, 'semester' => 2, 'description' => ''],

                // Year 3
                ['name' => 'Advanced Database Systems', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Distributed Systems', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Compiler Design', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Cryptography', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Big Data Technologies', 'year' => 3, 'semester' => 1, 'description' => ''],
                ['name' => 'Machine Learning', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Natural Language Processing', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Digital Forensics', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Internet of Things (IoT)', 'year' => 3, 'semester' => 2, 'description' => ''],
                ['name' => 'Software Project Management', 'year' => 3, 'semester' => 2, 'description' => ''],

                // Year 4
                ['name' => 'Final Year Project I', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Advanced Topics in AI', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Blockchain Technology', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Professional Ethics in IT', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Elective 1 (e.g., Game Development)', 'year' => 4, 'semester' => 1, 'description' => ''],
                ['name' => 'Final Year Project II', 'year' => 4, 'semester' => 2, 'description' => ''],
                ['name' => 'Internship', 'year' => 4, 'semester' => 2, 'description' => ''],
                ['name' => 'Seminar in Computer Science', 'year' => 4, 'semester' => 2, 'description' => ''],
                ['name' => 'Elective 2 (e.g., Quantum Computing)', 'year' => 4, 'semester' => 2, 'description' => ''],
            ];

            foreach ($csCourses as $courseData) {
                Course::create(array_merge($courseData, ['program_id' => $csProgram->id]));
            }
        }
    }
}