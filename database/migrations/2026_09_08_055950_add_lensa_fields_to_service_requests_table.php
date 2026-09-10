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
        Schema::table('service_requests', function (Blueprint $table) {
            $table->string('analyst')->nullable();
            $table->string('verificator')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('lembar_indikasi')->nullable();
            $table->string('surat_analisis_nomor')->nullable();
            $table->string('surat_analisis_dokumen')->nullable();
            $table->string('skat_nomor')->nullable();
            $table->date('masa_berlaku')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropColumn([
                'analyst', 'verificator', 'unit_kerja', 'lembar_indikasi',
                'surat_analisis_nomor', 'surat_analisis_dokumen', 'skat_nomor', 'masa_berlaku'
            ]);
        });
    }
};
