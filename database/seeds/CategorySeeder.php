<?php

use App\Models\Category;
use App\Models\Device;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(Category::class, 1000)->create()->each(function ($category) {
			$category->devices()->save(factory(Device::class)->make());
		});
    }
}
