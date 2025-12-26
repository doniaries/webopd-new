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
        Schema::dropIfExists('visi_misis');
        Schema::dropIfExists('visis');
        Schema::dropIfExists('misis');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reverse operation as we don't know the original schema
    }
};
