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
                ['name' => 'Python Programming 1', 'year' => 1, 'semester' => 1, 'description' => 'An introduction to the Python programming language.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Networking Essentials 1 (CISCO-ITE)', 'year' => 1, 'semester' => 1, 'description' => 'Learn the fundamentals of networking with Cisco.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Mathematics 1', 'year' => 1, 'semester' => 1, 'description' => 'A foundational course in mathematics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Introduction to Computer Science', 'year' => 1, 'semester' => 1, 'description' => 'An overview of the field of computer science.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Critical thinking', 'year' => 1, 'semester' => 1, 'description' => 'Develop your critical thinking skills.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Python Programming 2', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Python Programming 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Networking Essentials 2 (CISCO-ITE)', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Networking Essentials 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Mathematics 2', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Mathematics 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Architecture and Operating System', 'year' => 1, 'semester' => 2, 'description' => 'An introduction to computer architecture and operating systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Design Thinking', 'year' => 1, 'semester' => 2, 'description' => 'Learn the principles of design thinking.', 'credits' => 3, 'hours' => 45],

                // Year 2
                ['name' => 'Algorithms and Data Structures I', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to algorithms and data structures.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Object Oriented Programming I (Mobile App I)', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to object-oriented programming and mobile app development.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration I (CISCO CCNA)', 'year' => 2, 'semester' => 1, 'description' => 'Learn the fundamentals of network administration with Cisco.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Database & Advanced data techniques (MySQL)', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to databases and advanced data techniques.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Statistics and Probability', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to statistics and probability.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Algorithms and Data Structures II', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Algorithms and Data Structures I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Object Oriented Programming II (Mobile App II)', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Object Oriented Programming I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration II (CISCO CCNA)', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Network Administration I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 2, 'description' => 'An introduction to the principles of software engineering.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Static Web Development (HTML, CSS & JavaScript)', 'year' => 2, 'semester' => 2, 'description' => 'Learn the fundamentals of static web development.', 'credits' => 3, 'hours' => 45],

                // Year 3
                ['name' => 'Introduction to Data Science', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to the field of data science.', 'credits' => 3, 'hours' => 45],
                ['name' => 'IoT Project I', 'year' => 3, 'semester' => 1, 'description' => 'A project-based course on the Internet of Things.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration III (CISCO CCNA)', 'year' => 3, 'semester' => 1, 'description' => 'A continuation of Network Administration II.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Fundamentals of Cybersecurity', 'year' => 3, 'semester' => 1, 'description' => 'Learn the fundamentals of cybersecurity.', 'credits' => 3, 'hours' => 45],
                ['name' => 'ASP.NET Web App Development with C#-I', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to ASP.NET web app development with C#.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Data Science and Artificial Intelligence', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to data science and artificial intelligence.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Research Project II', 'year' => 3, 'semester' => 2, 'description' => 'A continuation of the research project.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Linux Administration I', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to Linux administration.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Ethical Hacking', 'year' => 3, 'semester' => 2, 'description' => 'Learn the principles of ethical hacking.', 'credits' => 3, 'hours' => 45],
                ['name' => 'ASP.NET Web App Development with C#-II', 'year' => 3, 'semester' => 2, 'description' => 'A continuation of ASP.NET Web App Development with C#-I.', 'credits' => 3, 'hours' => 45],

                // Year 4
                ['name' => 'Computer Vision and Machine Learning', 'year' => 4, 'semester' => 1, 'description' => 'An introduction to computer vision and machine learning.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Business Startup', 'year' => 4, 'semester' => 1, 'description' => 'Learn the fundamentals of starting a business.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Linux Administration II', 'year' => 4, 'semester' => 1, 'description' => 'A continuation of Linux Administration I.', 'credits' => 3, 'hours' => 45],
                ['name' => '*Internship (optional course) / CICSO / AWS', 'year' => 4, 'semester' => 1, 'description' => 'An optional internship course.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Research seminar', 'year' => 4, 'semester' => 1, 'description' => 'A seminar on research methods.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Seminar \ Workshop', 'year' => 4, 'semester' => 2, 'description' => 'A seminar and workshop on various topics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Project Completion & Thesis Writing', 'year' => 4, 'semester' => 2, 'description' => 'A course on project completion and thesis writing.', 'credits' => 3, 'hours' => 45],
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
                ['name' => 'Python Programming 1', 'year' => 1, 'semester' => 1, 'description' => 'An introduction to the Python programming language.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Networking Essentials 1 (CISCO-ITE)', 'year' => 1, 'semester' => 1, 'description' => 'Learn the fundamentals of networking with Cisco.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Mathematics 1', 'year' => 1, 'semester' => 1, 'description' => 'A foundational course in mathematics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Introduction to Computer Science', 'year' => 1, 'semester' => 1, 'description' => 'An overview of the field of computer science.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Critical thinking', 'year' => 1, 'semester' => 1, 'description' => 'Develop your critical thinking skills.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Python Programming 2', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Python Programming 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Networking Essentials 2 (CISCO-ITE)', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Networking Essentials 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Mathematics 2', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Mathematics 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Architecture and Operating System', 'year' => 1, 'semester' => 2, 'description' => 'An introduction to computer architecture and operating systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Design Thinking', 'year' => 1, 'semester' => 2, 'description' => 'Learn the principles of design thinking.', 'credits' => 3, 'hours' => 45],

                // Year 2
                ['name' => 'Algorithms and Data Structures I', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to algorithms and data structures.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Object Oriented Programming I (Mobile App I)', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to object-oriented programming and mobile app development.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration I (CISCO CCNA)', 'year' => 2, 'semester' => 1, 'description' => 'Learn the fundamentals of network administration with Cisco.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Database & Advanced data techniques (MySQL)', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to databases and advanced data techniques.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Statistics and Probability', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to statistics and probability.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Algorithms and Data Structures II', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Algorithms and Data Structures I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Object Oriented Programming II (Mobile App II)', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Object Oriented Programming I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration II (CISCO CCNA)', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Network Administration I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 2, 'description' => 'An introduction to the principles of software engineering.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Static Web Development (HTML, CSS & JavaScript)', 'year' => 2, 'semester' => 2, 'description' => 'Learn the fundamentals of static web development.', 'credits' => 3, 'hours' => 45],

                // Year 3
                ['name' => 'Introduction to Data Science', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to the field of data science.', 'credits' => 3, 'hours' => 45],
                ['name' => 'IOT Project', 'year' => 3, 'semester' => 1, 'description' => 'A project-based course on the Internet of Things.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration III (CISCO CCNA)', 'year' => 3, 'semester' => 1, 'description' => 'A continuation of Network Administration II.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Linux Administration I', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to Linux administration.', 'credits' => 3, 'hours' => 45],
                ['name' => 'ASP.NET Web App Development with C#-I', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to ASP.NET web app development with C#.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Data Science and Artificial Intelligence', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to data science and artificial intelligence.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Research Project', 'year' => 3, 'semester' => 2, 'description' => 'A research project in the field of business information technology.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Fundamentals of Cybersecurity', 'year' => 3, 'semester' => 2, 'description' => 'Learn the fundamentals of cybersecurity.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Linux Administration II', 'year' => 3, 'semester' => 2, 'description' => 'A continuation of Linux Administration I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'ASP.NET Web App Development with C#-II', 'year' => 3, 'semester' => 2, 'description' => 'A continuation of ASP.NET Web App Development with C#-I.', 'credits' => 3, 'hours' => 45],

                // Year 4
                ['name' => 'Computer Vision and Machine Learning', 'year' => 4, 'semester' => 1, 'description' => 'An introduction to computer vision and machine learning.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Business Startup', 'year' => 4, 'semester' => 1, 'description' => 'Learn the fundamentals of starting a business.', 'credits' => 3, 'hours' => 45],
                ['name' => 'AWS Cloud Computing for Developer', 'year' => 4, 'semester' => 1, 'description' => 'An introduction to AWS cloud computing for developers.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Ethical Hacking', 'year' => 4, 'semester' => 1, 'description' => 'Learn the principles of ethical hacking.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Research Methodology', 'year' => 4, 'semester' => 1, 'description' => 'A course on research methodology.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Project Completion & Thesis Writing', 'year' => 4, 'semester' => 2, 'description' => 'A course on project completion and thesis writing.', 'credits' => 3, 'hours' => 45],
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
                ['name' => 'Python Programming 1', 'year' => 1, 'semester' => 1, 'description' => 'An introduction to the Python programming language.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Networking Essentials 1 (CISCO-ITE)', 'year' => 1, 'semester' => 1, 'description' => 'Learn the fundamentals of networking with Cisco.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Mathematics 1', 'year' => 1, 'semester' => 1, 'description' => 'A foundational course in mathematics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Introduction to Computer Science', 'year' => 1, 'semester' => 1, 'description' => 'An overview of the field of computer science.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Critical thinking', 'year' => 1, 'semester' => 1, 'description' => 'Develop your critical thinking skills.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Python Programming 2', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Python Programming 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Networking Essentials 2 (CISCO-ITE)', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Networking Essentials 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Mathematics 2', 'year' => 1, 'semester' => 2, 'description' => 'A continuation of Mathematics 1.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Architecture and Operating System', 'year' => 1, 'semester' => 2, 'description' => 'An introduction to computer architecture and operating systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Design Thinking', 'year' => 1, 'semester' => 2, 'description' => 'Learn the principles of design thinking.', 'credits' => 3, 'hours' => 45],

                // Year 2
                ['name' => 'Algorithms and Data Structures I', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to algorithms and data structures.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Object Oriented Programming I (Mobile App I)', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to object-oriented programming and mobile app development.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration I (CISCO CCNA)', 'year' => 2, 'semester' => 1, 'description' => 'Learn the fundamentals of network administration with Cisco.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Database & Advanced data techniques (MySQL)', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to databases and advanced data techniques.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Statistics and Probability', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to statistics and probability.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Algorithms and Data Structures II', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Algorithms and Data Structures I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Object Oriented Programming II (Mobile App II)', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Object Oriented Programming I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Network Administration II (CISCO CCNA)', 'year' => 2, 'semester' => 2, 'description' => 'A continuation of Network Administration I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 2, 'description' => 'An introduction to the principles of software engineering.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Static Web Development (HTML, CSS & JavaScript)', 'year' => 2, 'semester' => 2, 'description' => 'Learn the fundamentals of static web development.', 'credits' => 3, 'hours' => 45],

                // Year 3
                ['name' => 'MATLAB', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to MATLAB.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Power Electronics I (POE-I)', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to power electronics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'IoT Project I', 'year' => 3, 'semester' => 1, 'description' => 'A project-based course on the Internet of Things.', 'credits' => 3, 'hours' => 45],
                ['name' => 'CAD Design', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to computer-aided design.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Circuits Design', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to circuit design.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Control Systems (CON-I)', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to control systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Power Electronics II (POE-II)', 'year' => 3, 'semester' => 2, 'description' => 'A continuation of Power Electronics I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Research Project II', 'year' => 3, 'semester' => 2, 'description' => 'A continuation of the research project.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Programming Logic Control(PLC)', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to programmable logic controllers.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Robot Operating System (ROS) I', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to the Robot Operating System.', 'credits' => 3, 'hours' => 45],

                // Year 4
                ['name' => 'Robotics Programming with ROS II', 'year' => 4, 'semester' => 1, 'description' => 'A continuation of Robotics Programming with ROS I.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Advanced Simulation Software', 'year' => 4, 'semester' => 1, 'description' => 'An introduction to advanced simulation software.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Control Systems (CON-II)', 'year' => 4, 'semester' => 1, 'description' => 'A continuation of Control Systems (CON-I).', 'credits' => 3, 'hours' => 45],
                ['name' => 'Computer Vision for Robotics', 'year' => 4, 'semester' => 1, 'description' => 'An introduction to computer vision for robotics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Research Methodology (Project Proposal)', 'year' => 4, 'semester' => 1, 'description' => 'A course on research methodology and project proposals.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Project Completion & Thesis Writing', 'year' => 4, 'semester' => 2, 'description' => 'A course on project completion and thesis writing.', 'credits' => 3, 'hours' => 45],
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
                ['name' => 'English Communication', 'year' => 1, 'semester' => 1, 'description' => 'Develop your English communication skills.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Calculus I', 'year' => 1, 'semester' => 1, 'description' => 'A foundational course in calculus.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Introduction to Computer Science and Programming', 'year' => 1, 'semester' => 1, 'description' => 'An overview of the field of computer science and programming.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Digital Logic and Computer Architecture', 'year' => 1, 'semester' => 1, 'description' => 'An introduction to digital logic and computer architecture.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Introduction to Web Development', 'year' => 1, 'semester' => 1, 'description' => 'Learn the fundamentals of web development.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Academic Writing', 'year' => 1, 'semester' => 2, 'description' => 'Develop your academic writing skills.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Discrete Mathematics', 'year' => 1, 'semester' => 2, 'description' => 'An introduction to discrete mathematics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Object-Oriented Programming', 'year' => 1, 'semester' => 2, 'description' => 'An introduction to object-oriented programming.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Data Structures and Algorithms', 'year' => 1, 'semester' => 2, 'description' => 'An introduction to data structures and algorithms.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Networking Fundamentals', 'year' => 1, 'semester' => 2, 'description' => 'Learn the fundamentals of networking.', 'credits' => 3, 'hours' => 45],

                // Year 2
                ['name' => 'Database Systems', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to database systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Operating Systems', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to operating systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Software Engineering', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to the principles of software engineering.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Computer Networks', 'year' => 2, 'semester' => 1, 'description' => 'An introduction to computer networks.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Web Application Development', 'year' => 2, 'semester' => 1, 'description' => 'Learn the fundamentals of web application development.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Mobile Application Development', 'year' => 2, 'semester' => 2, 'description' => 'Learn the fundamentals of mobile application development.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Introduction to Artificial Intelligence', 'year' => 2, 'semester' => 2, 'description' => 'An introduction to the field of artificial intelligence.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Cybersecurity Principles', 'year' => 2, 'semester' => 2, 'description' => 'Learn the principles of cybersecurity.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Cloud Computing', 'year' => 2, 'semester' => 2, 'description' => 'An introduction to cloud computing.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Human-Computer Interaction', 'year' => 2, 'semester' => 2, 'description' => 'An introduction to human-computer interaction.', 'credits' => 3, 'hours' => 45],

                // Year 3
                ['name' => 'Advanced Database Systems', 'year' => 3, 'semester' => 1, 'description' => 'A continuation of Database Systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Distributed Systems', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to distributed systems.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Compiler Design', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to compiler design.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Cryptography', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to cryptography.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Big Data Technologies', 'year' => 3, 'semester' => 1, 'description' => 'An introduction to big data technologies.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Machine Learning', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to machine learning.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Natural Language Processing', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to natural language processing.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Digital Forensics', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to digital forensics.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Internet of Things (IoT)', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to the Internet of Things.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Software Project Management', 'year' => 3, 'semester' => 2, 'description' => 'An introduction to software project management.', 'credits' => 3, 'hours' => 45],

                // Year 4
                ['name' => 'Final Year Project I', 'year' => 4, 'semester' => 1, 'description' => 'The first part of the final year project.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Advanced Topics in AI', 'year' => 4, 'semester' => 1, 'description' => 'A course on advanced topics in artificial intelligence.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Blockchain Technology', 'year' => 4, 'semester' => 1, 'description' => 'An introduction to blockchain technology.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Professional Ethics in IT', 'year' => 4, 'semester' => 1, 'description' => 'A course on professional ethics in IT.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Elective 1 (e.g., Game Development)', 'year' => 4, 'semester' => 1, 'description' => 'An elective course.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Final Year Project II', 'year' => 4, 'semester' => 2, 'description' => 'The second part of the final year project.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Internship', 'year' => 4, 'semester' => 2, 'description' => 'An internship in the field of computer science.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Seminar in Computer Science', 'year' => 4, 'semester' => 2, 'description' => 'A seminar on various topics in computer science.', 'credits' => 3, 'hours' => 45],
                ['name' => 'Elective 2 (e.g., Quantum Computing)', 'year' => 4, 'semester' => 2, 'description' => 'An elective course.', 'credits' => 3, 'hours' => 45],
            ];

            foreach ($csCourses as $courseData) {
                Course::create(array_merge($courseData, ['program_id' => $csProgram->id]));
            }
        }
    }
}