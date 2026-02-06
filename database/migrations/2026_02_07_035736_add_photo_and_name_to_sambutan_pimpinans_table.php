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
        Schema::table('sambutan_pimpinans', function (Blueprint $table) {
            $table->string('nama_pimpinan')->nullable()->after('slug');
            $table->string('foto_pimpinan')->nullable()->after('nama_pimpinan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sambutan_pimpinans', function (Blueprint $table) {
            $table->dropColumn(['nama_pimpinan', 'foto_pimpinan']);
        });
    }
};
