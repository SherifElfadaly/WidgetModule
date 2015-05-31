<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if ( ! Schema::hasTable('widget_types'))
		{
			Schema::create('widget_types', function(Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('widget_type_name', 255)->index();
				$table->string('template', 200)->index();
				$table->string('theme', 255)->index();
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
		if (Schema::hasTable('widget_types'))
		{
			Schema::drop('widget_types');
		}
	}
}