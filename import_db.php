<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::unprepared(file_get_contents('pelayanan_psdkp.sql'));
    echo "=========================================\n";
    echo "SUKSES: Database lokal berhasil di-import!\n";
    echo "=========================================\n";
} catch (\Exception $e) {
    echo "GAGAL: " . $e->getMessage() . "\n";
}
