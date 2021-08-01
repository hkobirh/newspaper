<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();
        foreach (range(1, 6) as $index) {
            $name = substr($faker->paragraph, 0, 20);
            Category::create([
                'user_id' => rand(1, 10),
                'name'    => $name ,
                'slug'    => slugify($name),
                'status'  => $this->random_status()
            ]);
        }
    }

    public function random_status()
    {
        $status = [
            'active'   => 'active',
            'inactive' => 'inactive'
        ];
        return array_rand($status, 1);
    }
}
