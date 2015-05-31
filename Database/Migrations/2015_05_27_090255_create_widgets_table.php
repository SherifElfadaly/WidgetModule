<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if ( ! Schema::hasTable('widgets'))
		{
			Schema::create('widgets', function(Blueprint $table) {
				$table->bigIncrements('id');;
				$table->string('slug', 150)->index();
				$table->bigInteger('image');
				$table->string('link', 150)->default('#')->index();
				$table->bigInteger('widget_type_id')->unsigned();
				$table->foreign('widget_type_id')->references('id')->on('widget_types');
				$table->bigInteger('user_id')->unsigned();
				$table->foreign('user_id')->references('id')->on('users');
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('widgets'))
		{
			Schema::drop('widgets');
		}
	}
}