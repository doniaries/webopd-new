<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Slider as SliderModel;

class Slider extends Component
{
    public function render()
    {
        // Slider relies on Post, let's just get all sliders for now or check if is_active exists.
        // Assuming Slider table might not have is_active based on model file.
        // We filter by valid post instead.
        $sliders = SliderModel::whereHas('post', function ($q) {
            $q->where('status', 'published');
        })
            ->get(); // Removed orderBy order if 'order' column is missing from fillable/schema

        return view('livewire.slider', [
            'sliders' => $sliders
        ]);
    }
}
