<!DOCTYPE html>
<html lang="en" x-data :class="{ 'dark': $store.theme.isDarkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Professors - IT Faculty - National University of Management</title>
    
    <link rel="icon" href="{{ asset('assets/logo/num-logo.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <style>
        .hero-bg-professors {
            background: linear-gradient(rgba(17, 24, 39, 0.7), rgba(17, 24, 39, 0.7)), url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    
    <div class="relative hero-bg-professors h-96">
        <div class="absolute top-0 left-0 w-full z-10">
            <x-navbar />
        </div>
        
        <div class="h-full flex items-center justify-center text-white">
            <div class="text-center px-4">
                <h1 class="text-5xl font-bold">Meet Our Faculty</h1>
                <p class="mt-4 text-xl text-gray-300">The dedicated minds shaping the future of technology.</p>
            </div>
        </div>
    </div>

    <main>
        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-6 lg:px-8">
                
                {{-- UPDATED: New card design with circular image and "Read More" functionality --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    @php
                        $professors = [
                             [
                                'name' => 'Professor Dr. Chhay Phang',
                                'title' => 'Dean of IT Faculty',
                                'image' => 'https://sc.num.edu.kh/images/170%2C281x278%2B0%2B0/12040525/Picture4.jpg',
                                'detail' => 'Received his DBA from NUM (2017), MBA from UMM Malaysia (2001), MSc. ICT from UUM Malaysia (2005), and BSc. in Computer Science from Hanoi University of Technology, Vietnam (1997). His teaching and research interests are Business Mathematics, Business Statistics, Management Information System, and Quantitative Analysis.'
                            ],
                            [
                                'name' => 'Dr. Chay Sengtha',
                                'title' => 'Advisor to NUM',
                                'image' => 'https://sc.num.edu.kh/images/170%2C189x193%2B0%2B4/12362890/teacherimage.jpg',
                                'detail' => 'Managing director at E-KHMER Technology Co., Ltd. Obtained a Master of Management and Information Technology from Kyoto University (2004) and a PhD in Applied Informatics from University of Hyogo (2011). Interested in teaching blockchain technology and business startups.'
                            ],
                            [
                                'name' => 'Associate Professor Dr. Chhun Rady',
                                'title' => 'Chief of IT Department',
                                'image' => 'https://sc.num.edu.kh/images/170%2C275x285%2B0%2B10/12458782/Picture1_Rady.jpg',
                                'detail' => 'Received his DBA from NUM (2012), MBA from UMM Malaysia (2001), and a Bachelor degree in accounting from NUM (1997). His primary teaching course is Research Methods.'
                            ],
                            [
                                'name' => 'Mr. Akira Morita',
                                'title' => 'Design Thinking Lecturer',
                                'image' => 'https://sc.num.edu.kh/images/170%2C190x209%2B0%2B5/12585881/photo_2024-12-1810.24.33.jpeg',
                                'detail' => '20 years of experience as a freelance designer and consultant. Holds a Master’s degree in Parks, Recreation, and Tourism Management from the US. Fluent in English and Japanese, he teaches Design Thinking at the Faculty of Digital Economy, NUM.'
                            ],
                            [
                                'name' => 'Mr. Oum Saokosal',
                                'title' => 'Part-time Lecturer',
                                'image' => 'https://sc.num.edu.kh/images/170%2C275x272%2B0%2B44/12040396/Picture1_Chanborey.jpg', 
                                'detail' => 'Dean of Faculty of Computer Science at NPIC. Holds a Master\'s Degree in Information Systems (2010) from Jeonju University, South Korea. His teaching interests are Mobile App Development, Computer Programming, and Data Science.'
                            ],
                            [
                                'name' => 'Dr. Cheav Kirirom',
                                'title' => 'Lecturer',
                                'image' => 'https://sc.num.edu.kh/images/170%2C281x279%2B0%2B8/12322534/Picture1_Kirirom.jpg',
                                'detail' => 'A government official at the National Audit Authority, he earned a Ph.D. in Economics from NUM in 2021. With a background in the airline industry, he is interested in Design Thinking and Research Methodology.'
                            ],
                            [
                                'name' => 'Dr. Hnin Myint',
                                'title' => 'R&D Manager, Orlando Ltd (UK)',
                                'image' => 'https://sc.num.edu.kh/images/170%2C275x274%2B0%2B82/12040430/Picture2.jpg',
                                'detail' => 'Awarded her Ph.D. in Computer Science from The Open University, UK (2018), focusing on AI, Machine Learning, and Computer Vision. Earned her International Master of IT with first-class honors from King Mongkut’s University of Technology, Thailand.'
                            ],
                            [
                                'name' => 'Mr. Sok Moniroith',
                                'title' => 'IT Lecturer & Web Developer',
                                'image' => 'https://sc.num.edu.kh/images/170%2C275x280%2B0%2B0/12322520/Picture1_moniroth.png',
                                'detail' => 'Over 10 years at NUM, he is a Web Developer responsible for the Learning Management System (LMS) and heads up Google Classroom integration. He earned his bachelor’s degree in IT from RUPP in 2005.'
                            ],
                            [
                                'name' => 'Asst. Prof. Sreng Vichet',
                                'title' => 'Assistant Professor',
                                'image' => 'https://sc.num.edu.kh/images/170%2C281x288%2B0%2B6/12322490/Picture1_Vichet.jpg',
                                'detail' => 'Holds a Master’s in IT and is a PhD candidate at ITC, specializing in Hybrid Optical Character Detection. He has extensive international training, including a UNESCO Data Science Camp on Machine Learning (2024).'
                            ],
                            [
                                'name' => 'Mr. Ngin Pidor',
                                'title' => 'Lecturer',
                                'image' => 'https://sc.num.edu.kh/images/170%2C383x408%2B0%2B18/12363339/Picture1_Pidor.jpg',
                                'detail' => 'Deputy director of the IT department with 15 years of experience in IT banking, project management, Blockchain, and FinTech. He obtained his master’s in business information technology from RMIT University Australia in 2016.'
                            ],
                            [
                                'name' => 'Mr. Lon Chanborey',
                                'title' => 'Founder/Director, LIT Solutions Ltd (UK)',
                                'image' => 'https://sc.num.edu.kh/images/170%2C275x272%2B0%2B44/12040396/Picture1_Chanborey.jpg',
                                'detail' => 'Over 15 years of experience in business management, cloud solutions, and cybersecurity. He holds two master’s degrees from the UK and Thailand and is a Microsoft Certified Trainer (MCT).'
                            ],
                            [
                                'name' => 'Mr. Try Socheat',
                                'title' => 'Lecturer & Director at GSPD',
                                'image' => 'https://sc.num.edu.kh/images/170%2C281x287%2B0%2B1/12363766/Picture1_Socheat.jpg',
                                'detail' => 'Currently a PhD candidate in Public Policy at UIBE, China. Holds Master\'s degrees in Smart City (SungKyungKwan University) and General Management (RULES). He has been teaching IT courses at NUM since 2011.'
                            ],
                            [
                                'name' => 'Mr. Dith Sochang',
                                'title' => 'Lecturer',
                                'image' => 'https://sc.num.edu.kh/images/170%2C284x286%2B0%2B1/12322549/Picture1_Sochang.png',
                                'detail' => 'Holds two master degrees in Master of Computer Applications from Bangalore University, India (2018) and Master of Finance from NUM (2013). His teaching covers business statistics, system administration, and network security.'
                            ],
                            [
                                'name' => 'Mr. Srun Channareth',
                                'title' => 'Lecturer & PhD Candidate',
                                'image' => 'https://sc.num.edu.kh/images/170%2C275x290%2B0%2B0/12363295/Picture1_channareth.png',
                                'detail' => 'Obtained his M.Eng in Electrical Engineering from Universitas Hasanuddin, Indonesia (2018). He is pursuing his PhD in Mechatronic and IT and leads the AI and Robotic Laboratory at NPIC.'
                            ],
                            [
                                'name' => 'Mr. Un Sok Oeun',
                                'title' => 'Lecturer & PhD Candidate',
                                'image' => 'https://sc.num.edu.kh/images/170%2C826x893%2B0%2B12/12539059/photo_2024-12-1611.15.21.jpeg',
                                'detail' => 'Received his M.Eng in Electrical and Telecommunication Systems from SoonChunHyang University, South Korea (2013). His research interests include Telecommunication Systems, Satellite Communication, and Amateur Radio Networks.'
                            ],
                            [
                                'name' => 'Dr. Kak Soky',
                                'title' => 'Lecturer',
                                'image' => 'https://sc.num.edu.kh/images/170%2C172x174%2B0%2B0/12363974/Picture1_Soky.png',
                                'detail' => 'Holder of a Doctorate in Informatics from Kyoto University, Japan, specializing in Automatic Speech Recognition. He has over 10 years of teaching and research experience and is currently an assistant to the Ministry of Land Management.'
                            ],
                            [
                                'name' => 'Mr. Kong Chanpanith',
                                'title' => 'Chief Sector of IT, National Bank of Cambodia',
                                'image' => 'https://sc.num.edu.kh/images/170%2C275x290%2B0%2B8/12458726/Picture1_Sophanit.jpg',
                                'detail' => 'Received his master\'s in ICT Convergence from Handong Global University (2019). His teaching includes Database Management, AI, IT Project Management, and Technology in Financial Services.'
                            ],
                             [
                                'name' => 'Mr. Phal Eangheng',
                                'title' => 'Engineer & Data Analyst',
                                'image' => 'https://sc.num.edu.kh/images/170%2C826x922%2B0%2B42/12364027/photo_2024-10-0810.08.17.jpeg',
                                'detail' => 'Skilled in Manufacturing Engineering and Industrial & Systems Engineering. With a Master’s in progress from Prince of Songkhla University, his expertise spans project management, data analysis, and engineering coordination.'
                            ],
                            [
                                'name' => 'Dr. Lim Pheng Un',
                                'title' => 'Lecturer',
                                'image' => 'https://sc.num.edu.kh/images/145%2C113x123%2B0%2B26/12432493/Picture1_PhengUn.jpg',
                                'detail' => 'Earned his MSc and PhD in Computer Science from Kangwon National University, South Korea (2017). He teaches Database Use & Design and Advanced Database Systems. His research interests include AI & Machine Learning.'
                            ],
                            [
                                'name' => 'Mr. Khun Sopheap',
                                'title' => 'Freelance Researcher',
                                'image' => 'https://sc.num.edu.kh/images/182%2C88x89%2B2%2B0/12458666/Picture1_Sopheap.png',
                                'detail' => 'Received both his bachelor\'s and master\'s degrees in Computer Engineering from Hiroshima University, Japan (2004, 2006). He teaches introduction to computer science, data structures, and digital systems.'
                            ],
                            [
                                'name' => 'Dr. Bonarin Hem',
                                'title' => 'Academic Leader',
                                'image' => 'https://sc.num.edu.kh/images/182%2C1050x1061%2B0%2B86/16757667/4x6-knYp059j_I9J51GJuQRyTw.jpg',
                                'detail' => 'A seasoned expert with a Ph.D. in Organization Development from Assumption University, Thailand. He specializes in strategic planning, quality assurance, and has served as President of private higher education institutions.'
                            ],
                        ];
                    @endphp

                    @foreach ($professors as $prof)
                        <div x-data="{ isExpanded: false }" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col transition-all duration-300">
                            
                            {{-- Image, Name, and Title Section --}}
                            <div class="p-6 text-center">
                                <img class="w-32 h-32 mx-auto rounded-full object-cover mb-4 shadow-md ring-4 ring-cyan-300 dark:ring-cyan-500" 
                                     src="{{ $prof['image'] ? $prof['image'] : 'https://via.placeholder.com/150/CBD5E0/4A5568?text=NUM' }}" 
                                     alt="{{ $prof['name'] }}">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $prof['name'] }}</h3>
                                <p class="text-lg font-semibold text-indigo-500 dark:text-indigo-400 mt-1">{{ $prof['title'] }}</p>
                            </div>
                            
                            {{-- Description Section with "Read More" --}}
                            <div class="p-6 pt-0 flex-grow flex flex-col">
                                <div class="flex-grow relative">
                                    <p class="text-md text-gray-600 dark:text-gray-400 leading-relaxed" 
                                       :class="{ 'line-clamp-4': !isExpanded }">
                                        {{ $prof['detail'] }}
                                    </p>
                                </div>
                                <button @click="isExpanded = !isExpanded" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline mt-4 self-center">
                                    <span x-show="!isExpanded">Read More</span>
                                    <span x-show="isExpanded">Read Less</span>
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </main>
    <x-footer />
</body>
</html>