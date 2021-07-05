<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //create the column that will become FK(=Foreign Key)
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            //set the column as FK
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            //delete the foreign key
            $table->dropForeign(['category_id']);

            //delete the columns
            $table->dropColumn('category_id');
        });
    }
}
