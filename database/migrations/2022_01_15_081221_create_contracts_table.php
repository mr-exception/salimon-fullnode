<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("contracts", function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string("address", 64)->index();
      $table->string("file_path", 128);
      $table->unsignedInteger("total_price");
      $table->unsignedInteger("comission");
      $table->unsignedInteger("fee");
      $table->unsignedSmallInteger("count");
      $table->unsignedSmallInteger("type");
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
    Schema::dropIfExists("contracts");
  }
}
