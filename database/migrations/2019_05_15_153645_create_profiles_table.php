<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('age')->unsigned();
            $table->enum('gender', ['MALE', 'FEMALE', 'OTHER']);
            $table->dateTime('date_of_birth');
            $table->text('address');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('marital_status', ['SINGLE', 'RELATIONSHIP']);
            $table->integer('height')->unsigned()->nullable()->comment('The height of the user in centimeters');
            $table->decimal('weight')->nullable()->comment('The weight of the user in KG');
            $table->integer('education_level_id')->unsigned()->nullable();
            $table->string('occupation')->nullable();
            $table->integer('number_of_children')->unsigned()->nullable();
            $table->integer('contraception_reason_id')->unsigned();
            $table->boolean('sexually_active');
            $table->boolean('pregnancy_status');
            $table->enum('religion', ['CHRISTIANITY', 'ISLAM', 'OTHER']);
            $table->enum('religion_sect', ['CATHOLIC', 'PENTECOSTAL', 'OTHER'])->nullable();
            $table->timestamps();
            $table->json('meta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
