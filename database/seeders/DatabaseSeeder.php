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
                'description' => '<p><strong>Summary:</strong> There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. </p>
                                        <ul>
                                            <li><strong>Length:</strong> 518 pages.</li>
                                            <li><strong>Format:</strong> DVD</li>
                                            <li><strong>Language Note:</strong> Icelandic dialogue; English subtitles.</li>
                                            <li><strong>Genre :</strong> Feature films, Fiction films, Drama</li>
                                            <li><strong>Topics:</strong> Friendship, Bullies, Pranks, School</li>
                                            <li><strong>Time Period:</strong> 2000s -- 21st century</li>
                                        </ul>',
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
                $borrows[] = [
                    'user_id' => $faker->randomElement($user_ids),
                    'book_instance_id' => ++$book_instances_id,
                    'book_at' => $book_at = $faker->dateTimeBetween('-30 days'),
                    'borrow_at' => match($status) {
                        BookStatus::WAIT_TO_PICK_UP,
                        BookStatus::BORROWING, BookStatus::RETURNED, BookStatus::EXPIRED => Carbon::make($book_at)->subDay(),
                    },
                    'expected_return_at' => match($status) {
                        BookStatus::WAIT_TO_PICK_UP,
                        BookStatus::BORROWING, BookStatus::RETURNED, BookStatus::EXPIRED => Carbon::make($book_at)->subDay()->addMonth(),
                    },
                    'actual_return_at' => match($status) {
                        BookStatus::RETURNED => Carbon::make($book_at)->subDay()->addDays(random_int(10, 20)),
                        default => null,
                    },
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
