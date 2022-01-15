<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractReportsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create("contract_reports", function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->uuid("contract_id")->index();
      $table->string("address", 64);
      $table->unsignedSmallInteger("status")->default(1);
      $table->unsignedSmallInteger("share");
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
    Schema::dropIfExists("contract_reports");
  }
}
