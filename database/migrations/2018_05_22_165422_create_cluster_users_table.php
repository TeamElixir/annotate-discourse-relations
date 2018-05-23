<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClusterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cluster_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cluster_id');
            $table->integer('user1_id');
            $table->integer('user2_id');
            $table->integer('user1_completed');
            $table->integer('user2_completed');
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
        Schema::dropIfExists('cluster_users');
    }
}
