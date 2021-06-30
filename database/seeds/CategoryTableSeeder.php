<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\category;
use Carbon\Carbon;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for ($i = 0; $i < 5; $i++) {
			DB::table('categories')->insert([
				'user_id' => rand(1,3),
				'name' => Str::random(10).'_cat',
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'description' => Str::random(16)
			]);
		}
    }
}
