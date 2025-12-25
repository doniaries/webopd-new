<?php

namespace Database\Seeders;

use App\Models\ExternalLink;
use Illuminate\Database\Seeder;

class ExternalLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            [
                'nama_link' => 'Dinas Koperasi dan UKM',
                'url' => 'https://kukm.kemendag.go.id/',
                'logo' => 'https://placehold.co/200x200/3b82f6/ffffff?text=KUKM',
            ],
            [
                'nama_link' => 'Kementerian Koperasi dan UKM',
                'url' => 'https://kemenkopukm.go.id/',
                'logo' => 'https://placehold.co/200x200/10b981/ffffff?text=Kemenkop',
            ],
            [
                'nama_link' => 'Layanan Perizinan Berusaha',
                'url' => 'https://oss.go.id/',
                'logo' => 'https://placehold.co/200x200/f59e0b/ffffff?text=OSS',
            ],
            [
                'nama_link' => 'BPJS Ketenagakerjaan',
                'url' => 'https://www.bpjsketenagakerjaan.go.id/',
                'logo' => 'https://placehold.co/200x200/ef4444/ffffff?text=BPJS+TK',
            ],
            [
                'nama_link' => 'BPJS Kesehatan',
                'url' => 'https://www.bpjs-kesehatan.go.id/',
                'logo' => 'https://placehold.co/200x200/8b5cf6/ffffff?text=BPJS+Kes',
            ],
            [
                'nama_link' => 'Dinas Tenaga Kerja',
                'url' => 'https://disnaker.kemnaker.go.id/',
                'logo' => 'https://placehold.co/200x200/ec4899/ffffff?text=Disnaker',
            ],
        ];

        foreach ($links as $link) {
            ExternalLink::updateOrCreate(
                ['url' => $link['url']],
                $link
            );
        }
    }
}
