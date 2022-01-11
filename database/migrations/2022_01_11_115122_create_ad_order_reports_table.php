<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdOrderReportsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("ad_order_reports", function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string("address", 128)->index();
      $table->uuid("order_id")->index();
      $table->unsignedSmallInteger("status")->default(1);
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
    Schema::dropIfExists("ad_order_reports");
  }
}
