<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description')
                ->nullable();
            $table->integer('creator')
                ->unsigned();
            $table->timestamps();

            $table->foreign('creator')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks_lists');
    }
}
