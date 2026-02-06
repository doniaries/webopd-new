<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\AgendaKegiatan;
use App\Models\Pengumuman;

class Home extends Component
{
    public function render()
    {
        $infografis = \Illuminate\Support\Facades\Cache::remember('home_infografis', 60 * 60, function () {
            return \App\Models\Infografis::where('is_active', true)
                ->latest()
                ->get();
        });

        return view('livewire.home', [
            'infografis' => $infografis,
            'pageTitle' => config('app.name'),
            'pageDescription' => 'Website Resmi ' . config('app.name'),
        ]);
    }
}
