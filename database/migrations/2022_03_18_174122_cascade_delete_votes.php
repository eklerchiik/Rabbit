<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CascadeDeleteVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign(['comment_id']);
            $table->foreign('comment_id')
                ->references('id')->on('comments')
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
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign(['comment_id']);
            $table->foreign('comment_id')
                ->references('id')->on('comments')
                ->change();
        });
    }
}
