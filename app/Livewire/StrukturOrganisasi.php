<?php

namespace App\Livewire;

use App\Models\StrukturOrganisasi as StrukturModel;
use Livewire\Component;
use Livewire\Attributes\Layout;

class StrukturOrganisasi extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        $kepalaDinas = StrukturModel::where('name', 'Kepala Dinas')->first();
        $sekretariat = StrukturModel::where('name', 'Sekretariat')->first();
        $subBagianTataUsaha = StrukturModel::where('name', 'Sub Bagian Tata Usaha')->first();

        $bidang = StrukturModel::whereNotIn('name', [
            'Kepala Dinas',
            'Sekretariat',
            'Sub Bagian Tata Usaha',
            'Unit Pelayanan Teknis Daerah (UPTD)',
            'Sub Bagian Tata Usaha UPTD'
        ])->get();

        $uptd = StrukturModel::where('name', 'Unit Pelayanan Teknis Daerah (UPTD)')->first();
        $subBagianUptd = StrukturModel::where('name', 'Sub Bagian Tata Usaha UPTD')->first();

        return view('livewire.struktur-organisasi', [
            'kepalaDinas' => $kepalaDinas,
            'sekretariat' => $sekretariat,
            'subBagianTataUsaha' => $subBagianTataUsaha,
            'bidang' => $bidang,
            'uptd' => $uptd,
            'subBagianUptd' => $subBagianUptd,
            'pageTitle' => 'Struktur Organisasi',
            'pageDescription' => 'Struktur Organisasi Dinas Komunikasi dan Informatika'
        ]);
    }
}
