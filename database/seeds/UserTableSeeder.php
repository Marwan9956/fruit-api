<?php

use Illuminate\Database\Seeder;
use App\User;
use App\News;
use App\category;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(User::class , 3)->create();
    }
}
