<?php

namespace App\Livewire;

use Livewire\Component;

class DokumenIndex extends Component
{
    use \Livewire\WithPagination;

    public $search = '';

    public function render()
    {
        $dokumens = \App\Models\Dokumen::query()
            ->whereNotNull('published_at')
            ->when($this->search, function ($query) {
                $query->where('nama_dokumen', 'like', '%' . $this->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $this->search . '%');
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('livewire.dokumen-index', [
            'dokumens' => $dokumens
        ]);
    }

    public function download($id)
    {
        $dokumen = \App\Models\Dokumen::findOrFail($id);
        $dokumen->increment('downloads');

        return response()->download(storage_path('app/public/' . $dokumen->file));
    }
}
