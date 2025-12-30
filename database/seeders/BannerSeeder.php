<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data
        Banner::truncate();

        // Create banners with placeholder images from placehold.co
        $banners = [
            [
                'id' => 1,
                'title' => 'Banner 1',
                'gambar' => 'https://placehold.co/1920x600/3b82f6/ffffff?text=Banner+1',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'title' => 'Banner 2',
                'gambar' => 'https://placehold.co/1920x600/10b981/ffffff?text=Banner+2',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'title' => 'Banner 3',
                'gambar' => 'https://placehold.co/1920x600/f59e0b/ffffff?text=Banner+3',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert banners
        foreach ($banners as $banner) {
            Banner::firstOrCreate(
                $banner
            );
        }

        $this->command->info('Successfully created banners!');
    }
}
