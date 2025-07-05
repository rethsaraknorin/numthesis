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
            'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'author' => 'Robert C. Martin',
            'publisher' => 'Prentice Hall',
            'publication_year' => 2008,
            'description' => 'A must-read for any software developer. This book is filled with practical advice on how to write clean, maintainable code.',
            'book_link' => 'https://www.oreilly.com/library/view/clean-code-a/9780136083238/',
            'picture' => 'books/clean-code.jpg',
            'book_types' => ['Programming', 'Software Craftsmanship']
        ]);

        Book::create([
            'title' => 'Laravel: Up & Running',
            'author' => 'Matt Stauffer',
            'publisher' => 'Reilly Media',
            'publication_year' => 2019,
            'description' => 'A comprehensive guide to the Laravel framework, covering everything from the basics to advanced topics.',
            'book_link' => 'https://www.oreilly.com/library/view/laravel-up/9781492041183/',
            'picture' => 'books/laravel-up-and-running.jpg',
            'book_types' => ['Web Development', 'PHP', 'Laravel']
        ]);
        
        Book::create([
            'title' => 'Python for Data Analysis',
            'author' => 'Wes McKinney',
            'publisher' => 'Reilly Media',
            'publication_year' => 2017,
            'description' => 'A practical guide to data analysis using the Python programming language.',
            'book_link' => 'https://www.oreilly.com/library/view/python-for-data/9781491957653/',
            'picture' => 'books/python-for-data-analysis.jpg',
            'book_types' => ['Data Science', 'Python', 'Programming']
        ]);

        Book::create([
            'title' => 'The Pragmatic Programmer: Your Journey to Mastery',
            'author' => 'David Thomas, Andrew Hunt',
            'publisher' => 'Addison-Wesley Professional',
            'publication_year' => 2019,
            'description' => 'A classic book that provides timeless advice on software development.',
            'book_link' => 'https://pragprog.com/titles/tpp20/the-pragmatic-programmer-20th-anniversary-edition/',
            'picture' => 'books/the-pragmatic-programmer.jpg',
            'book_types' => ['Programming', 'Software Craftsmanship']
        ]);
    }
}