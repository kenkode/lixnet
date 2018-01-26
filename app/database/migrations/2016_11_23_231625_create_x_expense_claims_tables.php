<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXExpenseClaimsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expense_claims', function(Blueprint $table){
			$table->increments('id');
			$table->string('claimer');
			$table->date('date_submitted');
			$table->string('status');
			$table->timestamps();
		});

		Schema::create('claim_receipts', function(Blueprint $table){
			$table->increments('id');
			$table->integer('claim_id')->unsigned()->nullable();
			$table->string('receipt_from');
			$table->date('transaction_date');
			$table->string('status');
			$table->timestamps();
		});

		Schema::create('claim_receipt_items', function(Blueprint $table){
			$table->increments('id');
			$table->integer('claimReceiptID')->unsigned();
			$table->string('description');
			$table->integer('quantity')->unsigned();
			$table->double('unit_price');
			$table->timestamps();

			$table->foreign('claimReceiptID')->references('id')->on('claim_receipts')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('expense_claims');
		Schema::drop('claim_receipts');
		Schema::drop('claim_receipt_items');
	}

}
