<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('timetable_title');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('description')->null;
            $table->timestamps();


            //foreign key user di in users table
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');


            //foreign field in the categories table
            $table->foreign('category_id')->references('id')
            ->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_tables');
    }
}
