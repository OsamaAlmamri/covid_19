<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempSavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_saves', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('data');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('team_work_id');
            $table->boolean('isReadSave')->default(0);
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
        Schema::dropIfExists('temp_saves');
    }
}
