<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            ShieldSeeder::class,   // Set up roles and permissions using Filament Shield
            UserSeeder::class,     // Then create users
        ]);

        // Create Super Admin
        $superAdmin = \App\Models\User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->syncRoles(['super_admin']);


        $this->call([
            StrukturOrganisasiSeeder::class,
            SambutanPimpinanSeeder::class,
            PengaturanSeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            BannerSeeder::class,
            InfografisSeeder::class,
            AgendaKegiatanSeeder::class,
            PengumumanSeeder::class,
            DokumenSeeder::class,
            ExternalLinkSeeder::class,
        ]);
    }
}
