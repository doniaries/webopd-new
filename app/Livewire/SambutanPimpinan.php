<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SambutanPimpinan as SambutanPimpinanModel;

class SambutanPimpinan extends Component
{
    public function render()
    {
        $sambutan = SambutanPimpinanModel::first();
        return view('livewire.sambutan-pimpinan', compact('sambutan'));
    }
}
