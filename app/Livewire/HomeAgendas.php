<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\AgendaKegiatan;

#[Lazy]
class HomeAgendas extends Component
{
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton-agenda');
    }

    public function render()
    {
        $agendas = AgendaKegiatan::query()
            ->where('dari_tanggal', '>=', now()->toDateString())
            ->orderBy('dari_tanggal')
            ->orderBy('waktu_mulai')
            ->take(7)
            ->get();

        return view('livewire.home-agendas', [
            'agendas' => $agendas,
        ]);
    }
}
