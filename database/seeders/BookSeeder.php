<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->delete();

        Book::create([
            'title' => 'កម្មវិធីឌីជីថលវាយតម្លៃសាស្រ្ដាចារ្',
            'author' => 'នី វង្សសុចិត្រា',
            'publisher' => 'នី វង្សសុចិត្រា',
            'publication_year' => 2024,
            'description' => '',
            'book_link' => 'https://drive.google.com/file/d/14h-eJ7aiPndxMdldfQuJI9HTD5uG7MiH/view?usp=sharing',
            'picture' => 'books/cover_top10_2024.png',
            'book_types' => ['Thesis']
        ]);
        
        Book::create([
            'title' => 'ប្រព័ន្ធបង់ប្រាក់ស្វ័យប្រវត្តិដោយប្រើ QR-Code និង NFC នៃចំណតយានជំនិះ ក្នុងសាកលវិទ្យាល័យជាតិគ្រប់គង',
            'author' => 'ជី វឌ្ឍនា',
            'publisher' => 'ជី វឌ្ឍនា',
            'publication_year' => 2024,
            'description' => '',
            'book_link' => 'https://drive.google.com/file/d/1k4LXLtpqyS3RV73R89PjrI6S1HkJDdmc/view?usp=sharing',
            'picture' => 'books/cover_top10_2024.png',
            'book_types' => ['Thesis']
        ]);

        Book::create([
            'title' => 'NUM VIRTUAL ASSISTANT',
            'author' => 'ឆៃ រ៉ាឈីត',
            'publisher' => 'ឆៃ រ៉ាឈីត',
            'publication_year' => 2024,
            'description' => '',
            'book_link' => 'https://drive.google.com/file/d/1PTxWBwEpCWvLen59EhjPG1INbklBZGFb/view?usp=sharing',
            'picture' => 'books/cover_top10_2024.png',
            'book_types' => ['Thesis']
        ]);

        Book::create([
            'title' => 'NUM-Faculty of Information Technology Website',
            'author' => 'គឹម សំណាង',
            'publisher' => 'គឹម សំណាង',
            'publication_year' => 2024,
            'description' => '',
            'book_link' => 'https://drive.google.com/file/d/1UCt3NpuptyB3wOGNjiAU74BlJhbQmbQj/view?usp=sharing',
            'picture' => 'books/cover_top10_2024.png',
            'book_types' => ['Thesis']
        ]);

        Book::create([
            'title' => 'NUM Online Meeting Website for University Students',
            'author' => 'រ័ត្ន ដរារាជ',
            'publisher' => 'រ័ត្ន ដរារាជ',
            'publication_year' => 2024,
            'description' => '',
            'book_link' => 'https://drive.google.com/file/d/1n-88EP2gB7QlfhBjUZQzIx-bBWwupLnD/view?usp=sharing',
            'picture' => 'books/cover_top10_2024.png',
            'book_types' => ['Thesis']
        ]);

        Book::create([
            'title' => 'NUM ONLINE EXAM',
            'author' => 'Peng Chaitet',
            'publisher' => 'Peng Chaitet',
            'publication_year' => 2024,
            'description' => '',
            'book_link' => 'https://drive.google.com/file/d/16kLMW-ylmdHrSBbfWmiylIKFVCu6xPQk/view?usp=sharing',
            'picture' => 'books/cover_top10_2024.png',
            'book_types' => ['Thesis']
        ]);

        Book::create([
            'title' => 'NUM CAM CONVERTER',
            'author' => 'រ៉ន ម៉េងហួយ',
            'publisher' => 'រ៉ន ម៉េងហួយ',
            'publication_year' => 2024,
            'description' => '',
            'book_link' => 'https://drive.google.com/file/d/1dXNMAZ3Y8eBN2jqHaXoctbKoNURPUZcv/view?usp=sharing',
            'picture' => 'books/cover_top10_2024.png',
            'book_types' => ['Thesis']
        ]);
    }
}