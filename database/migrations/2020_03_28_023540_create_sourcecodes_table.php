<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcecodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sourcecodes', function (Blueprint $table) {
            $table->id();
            $table->string('title','100');
            $table->integer('category_id');
            $table->text('content');
            $table->string('image');
            $table->string('video');
            $table->string('download');
            $table->string('slug');
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
        Schema::dropIfExists('sourcecodes');
    }
}
