<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Pengaturan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create default settings with logo Kabupaten Sijunjung
        $settings = [
            'name' => 'Dinas Ketenagakerjaan dan Transmigrasi',
            'slug' => 'dinas-tenagakerjaan-dan-transmigrasi',
            'kabupaten' => 'Sijunjung',
            'logo' => 'images/logo.png', // Logo Kabupaten Sijunjung
            'favicon' => null, // Akan diisi melalui admin
            'kepala_instansi' => 'David Rinaldo, SSTP',
            'jabatan_pimpinan' => 'Kepala Dinas Ketenagakerjaan dan Transmigrasi',
            'foto_pimpinan' => 'https://placehold.co/400x400/6366f1/ffffff?text=Kepala+Dinas',
            'alamat_instansi' => 'Gedung Bersama, Kabupaten Sijunjung',
            'no_telp_instansi' => '0754-12345',
            'email_instansi' => 'diskominfo@sijunjungkab.go.id',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
            'youtube' => 'https://youtube.com',
        ];

        // Create the settings record
        Pengaturan::create($settings);

        $this->command->info('Successfully created settings!');
    }
}
