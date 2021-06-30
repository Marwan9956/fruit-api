<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignForeignNewsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
		Schema::table('news', function (Blueprint $table) {
			$table->foreign('users_id')->references('id')->on('users');
			$table->foreign('category_id')->references('id')->on('categories');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::table('news', function (Blueprint $table) {
			//$table->dropForeign('user_id');
			//$table->dropForeign('category_id');
			$table->dropForeign('news_users_id_foreign');
			$table->dropForeign('news_category_id_foreign');
			
		});
		
    }
}
