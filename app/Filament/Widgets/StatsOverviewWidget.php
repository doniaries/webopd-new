<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use App\Models\Banner;
use App\Models\Dokumen;
use App\Models\Pengumuman;
use App\Models\AgendaKegiatan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;

class StatsOverviewWidget extends BaseStatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Post::count())
                ->description('Jumlah berita yang dipublikasikan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Total Pengumuman', Pengumuman::count())
                ->description('Jumlah pengumuman')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('warning')
                ->chart([3, 5, 4, 6, 7, 5, 6, 8]),

            Stat::make('Total Agenda', AgendaKegiatan::count())
                ->description('Jumlah agenda kegiatan')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info')
                ->chart([5, 4, 6, 5, 7, 6, 8, 7]),

            Stat::make('Total Dokumen', Dokumen::count())
                ->description('Jumlah dokumen tersedia')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart([4, 6, 5, 7, 6, 8, 7, 9]),

            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('danger')
                ->chart([2, 3, 4, 3, 5, 4, 6, 5]),
            Stat::make('Total Banner', Banner::count())
                ->description('Jumlah banner')
                ->descriptionIcon('heroicon-m-photo')
                ->color('purple')
                ->chart([2, 3, 4, 3, 5, 4, 6, 5]),
        ];
    }
}
