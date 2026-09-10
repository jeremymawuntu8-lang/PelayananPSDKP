<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('ships', function (Blueprint $t) {
            $t->id();
            $t->foreignId('company_id')->constrained()->cascadeOnDelete();
            $t->string('name');
            $t->string('transmitter_no')->nullable();
            $t->string('book_no')->nullable();
            $t->string('fishing_gear')->nullable();
            $t->string('size')->nullable();
            $t->string('sipi_no')->nullable();
            $t->date('sipi_start')->nullable();
            $t->date('sipi_end')->nullable();
            $t->string('dpi')->nullable();
            $t->string('home_port')->nullable();
            $t->string('pelabuhan_keluar_terakhir')->nullable();
            $t->string('slo_issuer')->nullable();
            $t->string('license_type')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('ships'); }
};
