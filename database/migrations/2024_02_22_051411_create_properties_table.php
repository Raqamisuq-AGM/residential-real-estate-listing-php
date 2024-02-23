<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("sqrfit")->nullable();
            $table->string("bed")->nullable();
            $table->string("bath")->nullable();
            $table->string("room")->nullable();
            $table->string("location")->nullable();
            $table->string("price")->nullable();
            $table->string("classification")->nullable();
            $table->string("type")->nullable();
            $table->string("dev_name")->nullable();
            $table->string("sell_type")->nullable();
            $table->string("rent_status")->nullable();
            $table->string("status")->nullable();
            $table->string("thumb")->nullable();
            $table->string("slider1")->nullable();
            $table->string("slider2")->nullable();
            $table->string("slider3")->nullable();
            $table->string("slider4")->nullable();
            $table->longText("description")->nullable();
            $table->string("post_by")->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
