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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0);
            // $table->unsignedBigInteger('user_id')->default(0)->change();
            $table->string('name');
            $table->string('name_katakana');
            $table->integer('review');
            $table->string('food_picture')->nullable();
            $table->longText('map_url')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->longText('comment');
            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
