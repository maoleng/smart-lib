<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\BookStatus;
use App\Enums\UserRole;
use App\Models\Author;
use App\Models\Book;
use App\Models\BookInstance;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Factory;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->createUser();
        $this->createCategory();
        $this->createAuthor();
        $this->createBook();


    }

    private function createCategory(): void
    {
        $categories = [
            'Arts & Music', 'Biographies', 'Business', 'Comics', 'Computers & Tech', 'Cooking', 'Edu & Reference',
            'Entertainment', 'Health & Fitness', 'History', 'Hobbies & Crafts', 'Home & Garden', 'Horror', 'Kids',
        ];
        Category::query()->insert(array_map(static fn ($category) => ['name' => $category], $categories));
    }

    private function createAuthor(): void
    {
        $faker = Factory::create();
        $authors = [];
        for ($i = 0; $i < 10; $i++) {
            $authors[] = [
                'name' => $faker->name(),
                'avatar' => 'https://cdn-icons-png.flaticon.com/512/1995/1995562.png',
            ];
        }
        Author::query()->insert($authors);
    }

    private function createBook(): void
    {
        $faker = Factory::create();
        $category_ids = Category::query()->pluck('id')->toArray();
        $author_ids = Author::query()->pluck('id')->toArray();
        $user_ids = User::query()->pluck('id')->toArray();

        $book_instances_id = 0;
        $books = [];
        $book_instances = [];
        $borrows = [];
        for ($i = 1; $i <= 12; $i++) {
            $title = $faker->sentence(3);
            $banner = $i < 10 ?
                "https://exprostudio.com/html/book_library/images/books/img-0$i.jpg" :
                "https://exprostudio.com/html/book_library/images/books/img-$i.jpg";
            $books[] = [
                'title' => $title,
                'slug' => Str::slug($title),
                'banner' => $banner,
                'description' => $faker->sentence(30),
                'ISBN' => $faker->isbn13(),
                'category_id' => $faker->randomElement($category_ids),
                'author_id' => $faker->randomElement($author_ids),
            ];
            $instances = random_int(10, 15);
            for ($j = 1; $j <= $instances; $j++) {
                $status = BookStatus::getRandomValue();
                $book_instances[] = [
                    'status' => $status,
                    'code' => strtoupper(Str::random(4)),
                    'book_id' => $i,
                ];

                if ($status === BookStatus::WAIT_TO_PICK_UP) {
                    $book_at = $faker->dateTimeBetween('-30 days');
                    $borrow_at = null;
                    $expected_return_at = null;
                    $actual_return_at = null;
                } elseif ($status === BookStatus::BORROWING) {
                    $book_at = $faker->dateTimeBetween('-30 days');
                    $borrow_at = Carbon::make($book_at)->addDay();
                    $expected_return_at = Carbon::make($book_at)->addDay()->addMonth();
                    $actual_return_at = null;
                } elseif ($status === BookStatus::RETURNED) {
                    $book_at = $faker->dateTimeBetween('-30 days');
                    $borrow_at = Carbon::make($book_at)->addDay();
                    $expected_return_at = Carbon::make($book_at)->addDay()->addMonth();
                    $actual_return_at = Carbon::make($book_at)->addDay()->addMonth()->subDays(random_int(10, 20));
                } else {
                    $book_at = $faker->dateTimeBetween('-45 days', '-31 days');
                    $borrow_at = Carbon::make($book_at)->addDay();
                    $expected_return_at = Carbon::make($book_at)->addDay()->addMonth();
                    $actual_return_at = null;
                }
                $borrows[] = [
                    'user_id' => $faker->randomElement($user_ids),
                    'book_instance_id' => ++$book_instances_id,
                    'book_at' => $book_at,
                    'borrow_at' => $borrow_at,
                    'expected_return_at' => $expected_return_at,
                    'actual_return_at' => $actual_return_at,
                ];
            }
        }

        Book::query()->insert($books);
        BookInstance::query()->insert($book_instances);
        Borrow::query()->insert($borrows);
    }

    private function createUser(): void
    {
        $faker = Factory::create();
        User::query()->create([
            'name' => 'Tài khoản admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role' => UserRole::ADMIN,
        ]);
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('123456'),
                'role' => UserRole::USER,
            ];
        }

        User::query()->insert($users);
    }

}
