<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CascadeDeletePostVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_votes', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('cascade')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_votes', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->change();
        });
    }
}
