<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXPettyCashItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pettycash_items', function(Blueprint $table){
			$table->increments('id');
			$table->integer('ac_trns')->unsigned();
			$table->string('item_name');
			$table->string('description');
			$table->string('quantity');
			$table->float('unit_price');
			$table->timestamps();

			$table->foreign('ac_trns')->references('id')->on('account_transactions')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pettycash_items');
	}

}
