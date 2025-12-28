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
        Schema::table('posts', function (Blueprint $table) {
            $table->json('gallery')->nullable()->after('foto_utama');
        });

        Schema::dropIfExists('post_galleries');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('post_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('gallery');
        });
    }
};
