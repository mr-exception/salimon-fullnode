<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacketsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("packets", function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->uuid("msg_id")->index();
      $table->smallInteger("msg_count");
      $table->smallInteger("position");
      $table->string("data_path", 128);
      $table->string("src", 64)->index();
      $table->string("dst", 64)->index();
      $table->unsignedSmallInteger("type");
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
    Schema::dropIfExists("packets");
  }
}
