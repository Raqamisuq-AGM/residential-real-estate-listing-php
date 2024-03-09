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
            $table->string("property_id")->nullable();
            $table->string("contact_number")->nullable();
            $table->string("price")->nullable();
            $table->string("space")->nullable();
            $table->string("district")->nullable();
            $table->string("rooms")->nullable();
            $table->string("dev_name")->nullable();
            $table->string("ready_construction")->nullable();
            $table->string("property_type")->nullable();
            $table->string("roof")->nullable();
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
