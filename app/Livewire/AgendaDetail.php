<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\AgendaKegiatan;

#[Lazy]
class AgendaDetail extends Component
{
    public AgendaKegiatan $agenda;

    public function mount(AgendaKegiatan $agenda)
    {
        $this->agenda = $agenda;
    }

    public function render()
    {
        return view('livewire.agenda-detail', [
            'pageTitle' => $this->agenda->nama_agenda,
        ]);
    }
}
