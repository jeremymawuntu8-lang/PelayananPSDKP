<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('service_requests', function (Blueprint $t) {
            $t->string('hasil_pengawasan')->nullable()->after('upt_terdekat');
        });
    }
    public function down(): void {
        Schema::table('service_requests', function (Blueprint $t) {
            $t->dropColumn('hasil_pengawasan');
        });
    }
};

