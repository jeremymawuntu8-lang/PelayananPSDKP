<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('service_requests', function (Blueprint $t) {
            $t->id();
            $t->string('token')->unique();
            $t->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('ship_id')->nullable()->constrained()->nullOnDelete();
            $t->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $t->string('category');
            $t->string('subject');
            $t->text('description')->nullable();
            $t->text('analysis')->nullable();
            $t->string('indikasi')->nullable();
            $t->string('indikasi_pelanggaran')->nullable();
            $t->string('duga_langgar')->nullable();
            $t->date('period_violation_start')->nullable();
            $t->date('period_violation_end')->nullable();
            $t->string('pelabuhan_keluar_terakhir')->nullable();
            $t->date('mulai_melanggar')->nullable();
            $t->integer('frekuensi_pelanggaran')->nullable();
            $t->string('upt_terdekat')->nullable();
            $t->string('status')->default('draft');
            $t->date('observation_date')->nullable();
            $t->decimal('latitude', 10, 7)->nullable();
            $t->decimal('longitude', 10, 7)->nullable();
            $t->text('company_response')->nullable();
            $t->text('officer_response')->nullable();
            $t->timestamp('submitted_at')->nullable();
            $t->timestamp('responded_at')->nullable();
            $t->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('service_requests'); }
};
