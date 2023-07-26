<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('media', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // New column for user ID
        $table->string('title');
        $table->string('type');
        $table->string('filename');
        $table->text('description')->nullable(); // New column for description
        $table->timestamps();

        // Add foreign key constraint for user_id
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
