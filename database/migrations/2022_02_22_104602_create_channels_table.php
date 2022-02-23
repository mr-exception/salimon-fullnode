<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("channels", function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->string("creator", 64);
      $table->string("member", 64)->index();
      $table->string("universal_id", 64)->index();
      $table->longText("key");
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
    Schema::dropIfExists("channels");
  }
}
