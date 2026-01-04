<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SambutanPimpinan as SambutanPimpinanModel;

class SambutanPimpinan extends Component
{
    public function render()
    {
        $sambutan = SambutanPimpinanModel::first();
        $pengaturan = \App\Models\Pengaturan::first();
        return view('livewire.sambutan-pimpinan', [
            'sambutan' => $sambutan,
            'pengaturan' => $pengaturan,
            'pageTitle' => 'Sambutan Pimpinan',
            'pageDescription' => 'Sambutan Pimpinan ' . ($pengaturan->name ?? 'Dinas Komunikasi dan Informatika'),
        ]);
    }
}
