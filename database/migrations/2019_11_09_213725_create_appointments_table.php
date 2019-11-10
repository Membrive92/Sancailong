<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');

            // fk specialty
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            // fk doctor
            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('users');
            // fk patient
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users');
            $table->date('scheduled_date');
            $table->time('scheduled_time');
            $table->string('type');
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
        Schema::dropIfExists('appointments');
    }
}