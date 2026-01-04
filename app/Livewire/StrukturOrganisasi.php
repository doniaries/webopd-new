<?php

namespace App\Livewire;

use App\Models\Pengaturan;
use App\Models\StrukturOrganisasi as StrukturModel;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;

class StrukturOrganisasi extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $strukturOrganisasi = StrukturModel::all();
        $pengaturan = Pengaturan::first();
        $siteName = $pengaturan->name ?? 'Dinas Komunikasi dan Informatika';

        return view('livewire.struktur-organisasi', [
            'strukturOrganisasi' => $strukturOrganisasi,
            'pageTitle' => 'Struktur Organisasi',
            'pageDescription' => 'Struktur Organisasi ' . $siteName,
            'siteName' => $siteName,
        ]);
    }
}
