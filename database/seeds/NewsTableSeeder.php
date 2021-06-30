<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\News;
use Illuminate\Support\Str;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for ($i = 0; $i < 12; $i++) {
			DB::table('news')->insert([
				'users_id' => rand(1,3),
				'title' => Str::random(10),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				'text' => Str::random(40),
				'category_id' => rand(2,6)
			]);
		}
    }
}
