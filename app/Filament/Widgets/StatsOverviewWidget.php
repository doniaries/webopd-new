<?php

namespace App\Filament\Widgets;

use App\Models\AgendaKegiatan;
use App\Models\Post;
use App\Models\Pengumuman;
use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todayVisits = Visit::whereDate('created_at', today())->count();
        $monthVisits = Visit::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        return [
            Stat::make('Total Berita', Post::where('status', 'published')->count())
                ->description('Berita yang dipublikasikan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            
            Stat::make('Agenda Mendatang', AgendaKegiatan::whereDate('dari_tanggal', '>', today())->count())
                ->description('Agenda yang akan datang')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('warning')
                ->chart([3, 5, 2, 4, 6, 7, 5, 6]),
            
            Stat::make('Pengumuman Aktif', Pengumuman::where('published_at', '<=', now())->count())
                ->description('Pengumuman terpublikasi')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('info')
                ->chart([2, 4, 3, 5, 4, 6, 5, 7]),
            
            Stat::make('Pengunjung Hari Ini', $todayVisits)
                ->description('Total kunjungan hari ini')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([10, 15, 12, 18, 20, 25, 22, $todayVisits]),
        ];
    }
}
