<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Request;
use App\Models\Visit;
use Carbon\Carbon;

class VisitorStats extends Component
{
    public $today;
    public $month;
    public $online;
    public $ip;

    public function mount()
    {
        $this->ip = Request::ip();

        // Ensure current visit is recorded (simple logic, ideally middleware handles this)
        // For this port, we'll assume middleware or basic tracking exists, 
        // or just calculate based on existing data.
        // Let's implement basic tracking here for display purposes if not in middleware.

        Visit::firstOrCreate([
            'ip_address' => $this->ip,
            'visit_date' => Carbon::today(),
        ], [
            'user_agent' => Request::userAgent(),
        ]);

        $this->calculateStats();
    }

    public function calculateStats()
    {
        $this->today = Visit::whereDate('created_at', Carbon::today())->count();
        $this->month = Visit::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Approximation for online users (active in last 5 minutes)
        // Note: usage of 'updated_at' or 'created_at' depends on how Visit model is updated
        $this->online = Visit::where('updated_at', '>=', Carbon::now()->subMinutes(5))->count();
        if ($this->online == 0) $this->online = 1; // At least current user
    }

    public function render()
    {
        return view('livewire.visitor-stats');
    }
}
