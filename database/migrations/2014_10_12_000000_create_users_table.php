<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//$2y$10$95BocASyqcUKYRWoEkLjdeZocW9J1UVRyqLd4IS/EX6...
//        'email', 'password', 'username', 'avatar', 'work_team_id', 'status', 'deleted_by', 'created_by',
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('status')->default(1);
            $table->integer('government')->default(0);
            $table->string('avatar')->default('images/avatar/avatar.png');
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('work_team_id')->nullable()->default(null);
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('work_team_id')->references('id')->on('work_teams')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();

        });
//        \Illuminate\Support\Facades\DB::table('users')->insert(
//             ['username' => 'test',
//                'password' => \Illuminate\Support\Facades\Hash::make('123'),
//                'phone' => '+967773569041',
//                'email' => 'admin@test.com',
//                'employee_number' => '16_0065',
//            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
