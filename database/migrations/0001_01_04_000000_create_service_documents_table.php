<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('service_documents', function (Blueprint $t) {
            $t->id();
            $t->foreignId('service_request_id')->constrained()->cascadeOnDelete();
            $t->string('type')->nullable();
            $t->string('nomor_surat')->nullable();
            $t->string('file_path');
            $t->string('original_name');
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('service_documents'); }
};
