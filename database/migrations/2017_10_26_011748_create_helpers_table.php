<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helpers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->text('description')
                ->nullable();
            $table->integer('helped_times')
                ->unsigned()
                ->default(1);
            $table->integer('task')
                ->unsigned()
                ->nullable();
            $table->integer('account')
                ->unsigned()
                ->nullable();
            $table->timestamps();

            $table->foreign('task')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade');
            $table->foreign('account')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('helpers');
    }
}
