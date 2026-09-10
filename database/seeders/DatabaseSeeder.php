<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Ship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
        * Seed the application's database.
        */
    public function run(): void
    {
        // 1. Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@psdkp.go.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Petugas
        User::create([
            'name' => 'Petugas PSDKP',
            'email' => 'petugas@psdkp.go.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);

        // 3. Company
        $company1 = Company::create([
            'name' => 'PT Maju Bahari Abadi',
            'phone' => '081234567890',
            'email' => 'contact@majubahari.com',
            'address' => 'Jl. Pelabuhan Perikanan No. 1, Jakarta Utara'
        ]);
        
        $company2 = Company::create([
            'name' => 'CV Nelayan Nusantara',
            'phone' => '089876543210',
            'email' => 'info@nelayannusantara.co.id',
            'address' => 'Kawasan Pelabuhan Bitung, Sulawesi Utara'
        ]);

        // Company User
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'company@example.com',
            'password' => Hash::make('company123'),
            'role' => 'company',
            'company_id' => $company1->id
        ]);

        // 4. Ships
        Ship::create([
            'company_id' => $company1->id,
            'name' => 'KM Bintang Samudera 01',
            'transmitter_no' => 'TRX-998811',
            'sipi_no' => 'SIP/992/DKP/2026',
            'home_port' => 'Muara Baru',
            'fishing_gear' => 'Purse Seine'
        ]);

        Ship::create([
            'company_id' => $company1->id,
            'name' => 'KM Bintang Samudera 02',
            'transmitter_no' => 'TRX-998812',
            'sipi_no' => 'SIP/993/DKP/2026',
            'home_port' => 'Muara Baru',
            'fishing_gear' => 'Purse Seine'
        ]);

        Ship::create([
            'company_id' => $company2->id,
            'name' => 'KM Nusantara Jaya',
            'transmitter_no' => 'TRX-776655',
            'sipi_no' => 'SIP/881/DKP/2026',
            'home_port' => 'Bitung',
            'fishing_gear' => 'Longline'
        ]);
    }
}
