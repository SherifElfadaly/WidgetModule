<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetPermission extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach (\CMS::coreModuleParts()->getModuleParts('widget') as $modulePart) 
		{
			if ($modulePart->part_key == 'WidgetTypes') 
			{
				\CMS::permissions()->insertDefaultItemPermissions(
				                 $modulePart->part_key, 
				                 $modulePart->id, 
				                 [
					                 'admin'   => ['show'],
					                 'manager' => ['show']
				                 ]);
			}
			else
			{
				\CMS::permissions()->insertDefaultItemPermissions(
					                 $modulePart->part_key, 
					                 $modulePart->id, 
					                 [
						                 'admin'   => ['show', 'add', 'edit', 'delete'],
						                 'manager' => ['show', 'edit']
					                 ]);
			}
		} 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach (\CMS::coreModuleParts()->getModuleParts('widget') as $modulePart) 
		{
			\CMS::deleteItemPermissions($modulePart->part_key);
		}
	}
}