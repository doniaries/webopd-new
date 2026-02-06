<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Banner as BannerModel;
use Livewire\Attributes\Lazy;

#[Lazy]
class Banner extends Component
{

    public function render()
    {
        $banners = \Illuminate\Support\Facades\Cache::remember('home_banners', 60 * 60, function () {
            return BannerModel::where('is_active', true)
                ->orderBy('id', 'asc')
                ->get();
        });

        return view('livewire.banner', [
            'banners' => $banners
        ]);
    }
}
