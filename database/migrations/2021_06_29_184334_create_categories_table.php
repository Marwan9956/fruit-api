<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
			$table->unsignedBigInteger('user_id');
            $table->string('name');
			$table->text('description');

            //$table->foreign('users_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('categories', function (Blueprint $table) {
			//$table->dropForeign('categories_users_id_foreign');
            $table->dropForeign(['user_id']);
		});
        Schema::dropIfExists('categories');
    }
}
