<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("transactions", function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string("address", 64)->index();
      $table->unsignedSmallInteger("type")->index();
      $table->unsignedBigInteger("amount");
      $table->unsignedInteger("date");
      $table->string("description", 256)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists("transactions");
  }
}
