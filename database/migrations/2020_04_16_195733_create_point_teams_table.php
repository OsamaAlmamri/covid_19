<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_teams', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('work_team_id');
            $table->unsignedBigInteger('check_point_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('check_point_id')->references('id')->on('check_points')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('point_teams');
    }
}
