<div>
    <x-page-header :title="$pageTitle" />

    <div class="py-8 bg-white dark:bg-zinc-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg shadow-md overflow-hidden border border-green-200 dark:border-green-800">

                <!-- Controls: Search & Month/Year Navigation -->
                <div class="p-4 flex flex-col md:flex-row justify-between items-center gap-4 border-b border-green-200 dark:border-green-800">
                    <div class="w-full md:w-1/3">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari agenda..." class="w-full border-gray-300 dark:border-gray-700 dark:bg-zinc-800 dark:text-gray-200 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                    </div>

                    <div class="flex items-center gap-2">
                        <button wire:click="previousMonth" class="px-3 py-1 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-50 dark:hover:bg-zinc-700">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <select wire:model.live="currentMonth" class="border-gray-300 dark:border-gray-700 dark:bg-zinc-800 dark:text-gray-200 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            @foreach($months as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>

                        <select wire:model.live="currentYear" class="border-gray-300 dark:border-gray-700 dark:bg-zinc-800 dark:text-gray-200 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            @foreach($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>

                        <button wire:click="nextMonth" class="px-3 py-1 bg-white dark:bg-zinc-800 border border-gray-300 dark:border-gray-700 rounded-md hover:bg-gray-50 dark:hover:bg-zinc-700">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>

                @if (count($agendas) > 0)
                <div class="w-full overflow-x-auto">
                    <table class="w-full table-auto divide-y divide-green-200 dark:divide-green-800">
                        <thead class="bg-blue-600 dark:bg-blue-800">
                            <tr>
                                <th scope="col" class="w-12 px-2 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-hashtag"></i>
                                </th>
                                <th scope="col" class="min-w-[250px] px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="far fa-calendar-alt mr-2"></i>Nama Kegiatan
                                </th>
                                <th scope="col" class="min-w-[110px] px-3 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="bi bi-flag mr-2"></i>Status
                                </th>
                                <th scope="col" class="min-w-[150px] px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Lokasi
                                </th>
                                <th scope="col" class="min-w-[120px] px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="far fa-calendar mr-2"></i>Tanggal
                                </th>
                                <th scope="col" class="min-w-[100px] px-3 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="far fa-clock mr-2"></i>Waktu
                                </th>
                                <th scope="col" class="w-24 px-2 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">
                                    <i class="fas fa-info-circle mr-1"></i>Detail
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($agendas as $index => $agenda)
                            @php
                            $endDate = \Carbon\Carbon::parse($agenda->sampai_tanggal ?? $agenda->dari_tanggal)->endOfDay();
                            $today = \Carbon\Carbon::today();
                            $isPastEvent = $today->gt($endDate);
                            $rowClass = $isPastEvent
                            ? 'bg-gray-50 dark:bg-zinc-900 text-gray-500 dark:text-gray-400'
                            : ($index % 2 === 0
                            ? 'bg-white dark:bg-zinc-800 hover:bg-green-50 dark:hover:bg-green-900/30'
                            : 'bg-gray-50 dark:bg-zinc-900 hover:bg-green-50 dark:hover:bg-green-900/30');
                            $rowClass .= ' transition-colors duration-200';
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td class="px-2 py-3 text-center text-sm font-medium">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs">
                                        {{ ($agendas->currentPage() - 1) * $agendas->perPage() + $loop->iteration }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-day {{ $isPastEvent ? 'text-gray-400 dark:text-gray-600' : 'text-green-500' }} text-lg mr-2"></i>
                                        <div class="min-w-0">
                                            <div class="flex items-center">
                                                <span class="text-sm font-medium {{ $isPastEvent ? 'text-gray-700 dark:text-gray-400' : 'text-gray-900 dark:text-white' }} truncate">
                                                    {{ $agenda->nama_agenda }}
                                                </span>
                                            </div>
                                            <div class="text-xs {{ $isPastEvent ? 'text-gray-400 dark:text-gray-600' : 'text-gray-500 dark:text-gray-400' }} truncate">
                                                {{ $agenda->penyelenggara }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    @php
                                    $status = $agenda->status ?? 'Mendatang';
                                    $badgeClass = match ($status) {
                                    'Berlangsung' => 'bg-green-600 text-white',
                                    'Selesai' => 'bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-gray-200',
                                    default => 'bg-yellow-300 text-gray-900',
                                    };
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                        {{ $status }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-map-marker-alt {{ $isPastEvent ? 'text-gray-400 dark:text-gray-600' : 'text-green-500' }} mr-2 flex-shrink-0"></i>
                                        <span class="truncate">{{ $agenda->tempat ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-sm">
                                    <div class="flex items-center">
                                        <i class="far fa-calendar text-green-500 mr-2 flex-shrink-0"></i>
                                        <div>
                                            <div>
                                                {{ indonesia_date($agenda->dari_tanggal, true) }}
                                                @if ($agenda->sampai_tanggal && $agenda->sampai_tanggal != $agenda->dari_tanggal)
                                                <span class="whitespace-nowrap">- {{ indonesia_date($agenda->sampai_tanggal, false) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-sm">
                                    <div class="flex items-center">
                                        <i class="far fa-clock {{ $isPastEvent ? 'text-gray-400 dark:text-gray-600' : 'text-green-500' }} mr-2 flex-shrink-0"></i>
                                        <span>
                                            {{ $agenda->waktu_mulai ? \Carbon\Carbon::parse($agenda->waktu_mulai)->format('H:i') : '-' }}
                                            @if($agenda->waktu_selesai)
                                            - {{ \Carbon\Carbon::parse($agenda->waktu_selesai)->format('H:i') }}
                                            @endif
                                            WIB
                                        </span>
                                    </div>
                                </td>
                                <td class="px-2 py-3 text-sm font-medium text-center">
                                    <a href="{{ route('agenda.show', $agenda->slug) }}" class="inline-flex items-center justify-center w-full px-2 py-1.5 border border-transparent text-xs font-medium rounded-md {{ $isPastEvent ? 'bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-400 dark:hover:bg-gray-600' : 'text-white bg-green-600 hover:bg-green-700' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors duration-200">
                                        <i class="far fa-eye mr-1"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 sm:px-6">
                    {{ $agendas->links() }}
                </div>
                @else
                <div class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 dark:bg-green-900 mb-4">
                        <i class="far fa-calendar-times text-2xl text-green-600 dark:text-green-400"></i>
                    </div>
                    <h3 class="text-lg font-medium mb-1">Tidak ada agenda</h3>
                    <p>Tidak ada agenda yang dijadwalkan untuk periode ini.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>