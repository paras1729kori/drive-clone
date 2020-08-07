<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //$table->enum('column_name', [values]);
            $table->enum('sub_folder', [0, 1])->nullable();
            $table->bigInteger('parent_folder')->nullable();
            $table->bigInteger('created_by');
            $table->enum('starred', [0,1])->default(0);
            $table->enum('favourites', [0,1])->default(0);
            $table->enum('protected', [0, 1]);
            // String is equivalent to Varchar written in documentation
            $table->string('password', 255)->nullable();
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
        Schema::dropIfExists('folders');
    }
}
