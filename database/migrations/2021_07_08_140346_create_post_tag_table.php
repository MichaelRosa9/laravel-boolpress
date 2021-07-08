<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')  // inside the brackets i give the name i want
                ->references('id')       // inside the brackets i refer to the element inside the table
                ->on('posts')           // inside the brackets i select which table i'm choosing from
                ->onDelete('cascade');  // this method allows me to delete the connection with the other table


            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id') // inside the brackets i give the name i want
                ->references('id')     // inside the brackets i refer to the element inside the table
                ->on('tags')          // inside the brackets i select which table i'm choosing from
                ->onDelete('cascade');// this method allows me to delete the connection with the other table
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
        Schema::dropIfExists('post_tag');
    }
}
