<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('work_team_id');
            $table->unsignedBigInteger('quarantine_area_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('quarantine_area_id')->references('id')->on('quarantine_areas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('work_team_id')->references('id')->on('work_teams')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('health_teams');
    }
}
