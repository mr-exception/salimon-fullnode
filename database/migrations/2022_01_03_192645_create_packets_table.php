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
        Schema::create('packets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('msg_id')->index();
            $table->smallInteger('msg_count');
            $table->smallInteger('position');
            $table->string('data', 1024);
            $table->string('src', 128)->index();
            $table->string('dst', 128)->index();
            $table->boolean('fetched')->default(false);
            $table->integer('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packets');
    }
}
