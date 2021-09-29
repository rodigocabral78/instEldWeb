<?php

use App\Models\Category;
use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Device::class, 100)->create()->each(function ($device) {
			$device->category()->save(factory(Category::class)->make());
		});
    }
}
