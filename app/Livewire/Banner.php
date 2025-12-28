<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Banner as BannerModel;
use Livewire\Attributes\Lazy;

#[Lazy]
class Banner extends Component
{
    public function placeholder()
    {
        return view('livewire.placeholders.skeleton-slider');
    }
    public function render()
    {
        $banners = BannerModel::where('is_active', true)
            ->orderBy('id', 'asc')
            ->get();

        return view('livewire.banner', [
            'banners' => $banners
        ]);
    }
}
