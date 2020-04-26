<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockedPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocked_people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bp_name');
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->unsignedBigInteger('birth_date')->nullable();
            $table->string('country')->default('yemen');
            $table->string('other_place_data')->nullable();
            $table->string('id_type')->nullable()->default('ssn');
            $table->string('id_number')->nullable();
            $table->unsignedBigInteger('zone_id');
            $table->unsignedBigInteger('compared_by');
            $table->unsignedBigInteger('checked_by');
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade')->onUpunsignedBigInteger('cascade');
            $table->string('job')->nullable();
            $table->string('phone')->nullable();
            $table->string('relative_phone')->nullable();
            $table->unsignedBigInteger('check_point_id');
            $table->foreign('check_point_id')->references('id')->on('check_points')->onDelete('cascade')->onUpunsignedBigInteger('cascade');
           $table->enum('bp_type', ['truck_owner', 'people'])->default('people');
            $table->enum('bp_from', ['yemeni', 'arabic', 'align'])->default('yemeni');
            $table->enum('typeStatus',
                ['checkAndTruckInPort', 'checkedAndCrossedFromPort',
                    'JustChecked', 'examinedAndQuarantined',
                    'noActionTaken'])->default('noActionTaken');
            $table->string('truck_number')->nullable();

            $table->unsignedBigInteger('last_zone_visit_id')->nullable()->default(null);
            $table->foreign('last_zone_visit_id')->references('id')->on('zones')->onDelete('cascade')->onUpunsignedBigInteger('cascade');
            $table->unsignedBigInteger('start_date_symptoms')->nullable();

            $table->boolean('sleeping')->default(false);
            $table->unsignedBigInteger('sleep_date')->nullable();
            $table->unsignedBigInteger('insulation_date')->nullable();
            $table->enum('status_at_reporting', ['stable', 'critical', 'healing'])->default('stable');
            $table->boolean('fever_symptoms')->default(false);
            $table->boolean('sore_throat_symptoms')->default(false);
            $table->boolean('cough_symptoms')->default(false);
            $table->boolean('descent_from_the_nose_symptoms')->default(false);
            $table->boolean('breathing_difficulty_symptoms')->default(false);
            $table->boolean('headache_symptoms')->default(false);
            $table->boolean('pain_in_chest')->default(false);
            $table->boolean('pain_in_the_joints')->default(false);
            $table->string('others_symptoms')->nullable();

            $table->boolean('heart_disease')->default(false);
            $table->boolean('blood_pressure_disease')->default(false);
            $table->boolean('diabetes_disease')->default(false);
            $table->boolean('immunodeficiency_diseases')->default(false);
            $table->boolean('liver_diseases')->default(false);
            $table->boolean('chronic_respiratory_disease')->default(false);;
            $table->boolean('kidney_disease')->default(false);;
            $table->string('other_diseases')->nullable();


            $table->boolean('is_pregnant')->default(false);;
            $table->boolean('is_pregnant_in_first_3Month')->default(false);;
            $table->boolean('after_childbirth')->default(false);;



            $table->boolean('is_comming_from_other_country')->default(false);
            $table->string('come_from_country')->nullable();
//            $table->unsignedBigInteger('comming_date')->nullable();
            $table->unsignedBigInteger('out_from_country_date')->nullable();
            $table->unsignedBigInteger('comming_to_yemen_date')->nullable();
            $table->boolean('is_visit_health_center')->default(false);
            $table->string('health_center_name')->nullable();


            $table->boolean('is_mix_other_people')->default(false);
            $table->enum('mix_people_type', ['family', 'healthWorker', 'both', 'none'])->default('none');
            $table->string('other_mix_people')->nullable();

            $table->boolean('is_patientIdentical_standard_definition')->default(false);
            $table->boolean('is_sample_collected')->default(false);
            $table->boolean('is_sample_sent')->default(false);
            $table->unsignedBigInteger('sample_sent_date')->nullable();
            $table->enum('result_of_examining', ['indicates', 'passive', 'hangs', 'indecisive', 'none'])->default('none');
            $table->enum('situation_result', ['cured', 'dead', 'referred', 'none'])->default('none');

            $table->unsignedBigInteger('if_dead_date')->default(false);
            $table->unsignedBigInteger('out_date')->default(false);
            $table->unsignedBigInteger('quarantine_area_id')->nullable()->default(null);
            $table->foreign('quarantine_area_id')->references('id')->on('quarantine_areas')->onDelete('cascade')->onUpunsignedBigInteger('cascade');

            $table->unsignedBigInteger('if_transfer_where')->nullable()->default(null);
            $table->foreign('if_transfer_where')->references('id')->on('quarantine_areas')->onDelete('cascade')->onUpunsignedBigInteger('cascade');



            $table->enum('response_team_interventions',
                ['investigation', 'file_closed', 'case_was_lost',
                    'other', 'none'])->default('none');



            $table->string('other_response_team_interventions')->nullable();
            $table->string('note')->nullable();

            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpunsignedBigInteger('cascade');
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade')->onUpunsignedBigInteger('cascade');
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
        Schema::dropIfExists('blocked_people');
    }
}
