<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldCategorySourcecode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // menghapus field category_id ketika di migrate
        Schema::table('sourcecodes', function(Blueprint $table){
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // menambah field categiry_id ketika di rollback
        Schema::table('sourcecodes', function(Blueprint $table){
            $table->integer('category_id');
        });
    }
}
