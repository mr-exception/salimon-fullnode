<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("ad_orders", function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string("address", 64);
      $table->unsignedSmallInteger("status")->default(1);
      $table->unsignedBigInteger("price");
      $table->unsignedInteger("count");
      $table->string("data_path", 128);
      $table->unsignedInteger("size");
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
    Schema::dropIfExists("ad_orders");
  }
}
