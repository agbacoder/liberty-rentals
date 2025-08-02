<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                "title" => "The Midnight Library",
                "author" => "Matt Haig",
                "genre" => "Fiction",
                "published_year" => "2020",
                "total_copies" => 19,
            ],
            [
                "title" => "Educated",
                "author" => "Tara Westover",
                "genre" => "Memoir",
                "published_year" => "2018",
                "total_copies" => 12,
            ],
            [
                "title" => "Atomic Habits",
                "author" => "James Clear",
                "genre" => "Self-help",
                "published_year" => "2018",
                "total_copies" => 20,
            ],
            [
                "title" => "1984",
                "author" => "George Orwell",
                "genre" => "Dystopian",
                "published_year" => "1949",
                "total_copies" => 25,
            ],
            [
                "title" => "Becoming",
                "author" => "Michelle Obama",
                "genre" => "Biography",
                "published_year" => "2018",
                "total_copies" => 17,
            ],
            [
                "title" => "The Alchemist",
                "author" => "Paulo Coelho",
                "genre" => "Fiction",
                "published_year" => "1988",
                "total_copies" => 18,
            ],
            [
                "title" => "Sapiens",
                "author" => "Yuval Noah Harari",
                "genre" => "History",
                "published_year" => "2011",
                "total_copies" => 22,
            ],
            [
                "title" => "The Book Thief",
                "author" => "Markus Zusak",
                "genre" => "Historical Fiction",
                "published_year" => "2005",
                "total_copies" => 16,
            ],
            [
                "title" => "Dune",
                "author" => "Frank Herbert",
                "genre" => "Science Fiction",
                "published_year" => "1965",
                "total_copies" => 20,
            ],
            [
                "title" => "To Kill a Mockingbird",
                "author" => "Harper Lee",
                "genre" => "Classic",
                "published_year" => "1960",
                "total_copies" => 24,
            ],
            [
                "title" => "The Power of Now",
                "author" => "Eckhart Tolle",
                "genre" => "Spirituality",
                "published_year" => "1997",
                "total_copies" => 15,
            ],
            [
                "title" => "The Silent Patient",
                "author" => "Alex Michaelides",
                "genre" => "Thriller",
                "published_year" => "2019",
                "total_copies" => 14,
            ],
            [
                "title" => "The Four Agreements",
                "author" => "Don Miguel Ruiz",
                "genre" => "Self-help",
                "published_year" => "1997",
                "total_copies" => 10,
            ],
            [
                "title" => "Thinking, Fast and Slow",
                "author" => "Daniel Kahneman",
                "genre" => "Psychology",
                "published_year" => "2011",
                "total_copies" => 13,
            ],
            [
                "title" => "A Promised Land",
                "author" => "Barack Obama",
                "genre" => "Biography",
                "published_year" => "2020",
                "total_copies" => 21,
            ],
            [
                "title" => "The Subtle Art of Not Giving a F*ck",
                "author" => "Mark Manson",
                "genre" => "Self-help",
                "published_year" => "2016",
                "total_copies" => 18,
            ],
            [
                "title" => "Where the Crawdads Sing",
                "author" => "Delia Owens",
                "genre" => "Fiction",
                "published_year" => "2018",
                "total_copies" => 14,
            ],
            [
                "title" => "Normal People",
                "author" => "Sally Rooney",
                "genre" => "Fiction",
                "published_year" => "2018",
                "total_copies" => 16,
            ],
            [
                "title" => "The Catcher in the Rye",
                "author" => "J.D. Salinger",
                "genre" => "Classic",
                "published_year" => "1951",
                "total_copies" => 12,
            ],
            [
                "title" => "The Great Gatsby",
                "author" => "F. Scott Fitzgerald",
                "genre" => "Classic",
                "published_year" => "1925",
                "total_copies" => 19,
            ],
        ];

        foreach ($books as $book) {
            Book::updateOrCreate(
                ['title' => $book['title']],
                array_merge($book, ['available_copies' => $book['total_copies']])
            );
        }
    }
}
