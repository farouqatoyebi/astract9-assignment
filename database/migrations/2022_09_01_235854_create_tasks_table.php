<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id', false, true)->nullable()->index();
            $table->string('title', 191)->nullable()->index();
            $table->integer('category_id', false, true)->nullable()->index();
            $table->dateTime('deadline')->nullable()->index();
            $table->enum('status', ['pending', 'done', 'overdue'])->nullable()->index();
            $table->enum('last_modified_by', ['admin', 'me'])->nullable()->index();
            $table->enum('deleted', ['0', '1'])->nullable()->index();
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
        Schema::dropIfExists('tasks');
    }
}
