<?php

use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: tests
         */
        Schema::create('tests', function ($table) {
            $table->increments('id');
            $table->string('name', 100)->nullable();
            $table->string('slug', 200)->nullable();
            $table->enum('status', ['draft', 'published', 'hidden', 'suspended', 'spam'])->default('draft')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('upload_folder', 100)->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /*
    * Reverse the migrations.
    *
    * @return void
    */

    public function down()
    {
        Schema::drop('tests');
    }
}
