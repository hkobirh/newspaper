<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        foreach (range(1, 30) as $index) {
            Post::create([
                'user_id'     => rand(1, 6),
                'category_id' => rand(1, 6),
                'title'       => $faker->text,
                'description' => $faker->paragraphs(2, true),
                'image'       => 'logo.png',
                'status'      => random_status(),
            ]);
        }
    }
}
