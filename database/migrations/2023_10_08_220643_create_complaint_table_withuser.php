<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('complaint', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');

            // Add a foreign key constraint to link the user_id column to the id column of the users table
            $table->foreign('user_id')->references('id')->on('users');

            // You can add more columns or modifications here if needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complaint_table_withuser');
    }
};
