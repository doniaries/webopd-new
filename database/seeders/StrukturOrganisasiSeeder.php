<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run()
    {
        $structures = [
            // Pimpinan Tertinggi
            [
                'name' => 'Kepala Dinas',
                'description' => 'Pimpinan Tertinggi Dinas Komunikasi dan Informatika',
                'pimpinan' => 'Mas Adi Komar, S.STP., M.Tr.A.P.',
                'image' => null,
            ],
            // Sekretariat
            [
                'name' => 'Sekretariat',
                'description' => 'Administrasi Dinas, meliputi perencanaan dan pelaporan, keuangan dan aset, kepegawaian, umum.',
                'pimpinan' => 'Bayu Rakhmana, S.STP, M.H',
                'image' => null,
            ],
            [
                'name' => 'Sub Bagian Tata Usaha',
                'description' => 'Bagian dari Sekretariat yang mengurus ketatausahaan.',
                'pimpinan' => 'Hj. Astria Priantie, S.E., M.M.',
                'image' => null,
            ],
            // Bidang-Bidang
            [
                'name' => 'E-Government',
                'description' => 'Tata kelola pemerintahan berbasis elektronik, meliputi tata kelola, pengelolaan infrastruktur, dan layanan.',
                'pimpinan' => 'H. Mark Aditya, S.E., M.T.',
                'image' => null,
            ],
            [
                'name' => 'Aplikasi Informatika',
                'description' => 'Rekayasa aplikasi, integrasi dan interoperabilitas, dan pengelolaan aplikasi.',
                'pimpinan' => 'Dian Istanti, S.Sos., M.A.P.',
                'image' => null,
            ],
            [
                'name' => 'Informasi Komunikasi Publik',
                'description' => 'Pengolahan dan penyediaan informasi, komunikasi publik dan kehumasan, serta kemitraan komunikasi.',
                'pimpinan' => 'Nidar Nadrotan Naim Sujana, S.T., M.T.',
                'image' => null,
            ],
            [
                'name' => 'Persandian dan Keamanan Informasi',
                'description' => 'Persandian, keamanan informasi, serta layanan keamanan informasi.',
                'pimpinan' => 'Asep Denny Surbakti, S.T., M.T.',
                'image' => null,
            ],
            [
                'name' => 'Statistik',
                'description' => 'Kompilasi data, pengolahan data, serta penyajian data.',
                'pimpinan' => 'Indah Lesmini, S.Si.',
                'image' => null,
            ],
            // UPTD
            [
                'name' => 'Unit Pelayanan Teknis Daerah (UPTD)',
                'description' => 'Pusat Layanan Digital, Data, dan Informasi Geospasial.',
                'pimpinan' => 'Rizki Hustinisari, S.T., M.T.',
                'image' => null,
            ],
            [
                'name' => 'Sub Bagian Tata Usaha UPTD',
                'description' => 'Bagian administrasi Unit Pelayanan Teknis Daerah.',
                'pimpinan' => 'Gustiman, S.Sos.',
                'image' => null,
            ],
        ];

        foreach ($structures as $data) {
            StrukturOrganisasi::firstOrCreate(
                ['name' => $data['name']],
                [
                    'description' => $data['description'],
                    'pimpinan' => $data['pimpinan'],
                    'image' => $data['image'],
                    'slug' => Str::slug($data['name']),
                ]
            );
        }
    }
}
