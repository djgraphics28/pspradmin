<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Instructor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //initial data for Instructor
        Instructor::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'title' => 'MR',
            'position' => 'Pilot II',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        //initial data for Category
        Category::create([
            'name' => fake()->name(),
            'slug' => Str::slug(fake()->name()),
        ]);

        //initial Lesson
        Lesson::create([
            'title' => fake()->name(),
            'description' => fake()->text(),
            'content' => fake()->text(),
            'category_id' => 1,
            'instructor_id' => 1,
        ]);

        //Initial Data for Quiz
        Quiz::create([
            'title' => fake()->name(),
            'description' => fake()->text(),
            'lesson_id' => 1,
            'time_limit' => 10,
            'number_of_items' => 30,
        ]);

    }
}
