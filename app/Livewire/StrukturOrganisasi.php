<?php

namespace App\Livewire;

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

        return view('livewire.struktur-organisasi', [
            'strukturOrganisasi' => $strukturOrganisasi,
            'pageTitle' => 'Struktur Organisasi',
            'pageDescription' => 'Struktur Organisasi Dinas Komunikasi dan Informatika'
        ]);
    }
}
