<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('job')->nullable();
            $table->string('phone')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('join_date')->nullable();
            $table->string('country')->default('yemen');
            $table->string('ssn')->nullable();
            $table->enum('workType', ['point', 'health', 'admin'])->default('health');
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('work_teams');
    }
}
