<?php

namespace App\Filament\Resources\Pengaturans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PengaturanTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\Layout\Split::make([
                    ImageColumn::make('logo')
                        ->label('Logo')
                        ->disk('public')
                        ->visibility('public')
                        ->circular()
                        ->imageWidth(50)
                        ->imageHeight(50)
                        ->grow(false),

                    \Filament\Tables\Columns\Layout\Stack::make([
                        TextColumn::make('name')
                            ->weight('bold')
                            ->wrap()
                            ->searchable(),
                        TextColumn::make('kepala_instansi')
                            // ->prefix('Kepala: ')
                            ->icon('heroicon-m-user')
                            ->size('sm')
                            ->color('gray'),
                        TextColumn::make('alamat_instansi')
                            ->icon('heroicon-m-map-pin')
                            ->size('sm')
                            ->color('gray')
                            ->wrap(),
                    ])->space(1),
                    \Filament\Tables\Columns\Layout\Stack::make([
                        TextColumn::make('contact_label')
                            ->default('Kontak & Media Sosial')
                            ->weight('bold')
                            ->size('sm')
                            ->color('primary'),
                        TextColumn::make('email_instansi')
                            ->icon('heroicon-m-envelope')
                            ->size('sm')
                            ->url(fn($record) => $record?->email_instansi ? 'mailto:' . $record->email_instansi : null),
                        TextColumn::make('no_telp_instansi')
                            ->icon('heroicon-m-phone')
                            ->size('sm'),
                        TextColumn::make('facebook')
                            ->icon('heroicon-m-globe-alt')
                            ->label('Facebook')
                            ->formatStateUsing(fn() => 'Facebook')
                            ->url(fn($record) => $record?->facebook)
                            ->openUrlInNewTab()
                            ->color('gray')
                            ->size('sm')
                            ->visible(fn($record) => filled($record?->facebook)),
                        TextColumn::make('instagram')
                            ->icon('heroicon-m-globe-alt')
                            ->label('Instagram')
                            ->formatStateUsing(fn() => 'Instagram')
                            ->url(fn($record) => $record?->instagram)
                            ->openUrlInNewTab()
                            ->color('gray')
                            ->size('sm')
                            ->visible(fn($record) => filled($record?->instagram)),
                    ])->space(1),
                    \Filament\Tables\Columns\Layout\Stack::make([
                        TextColumn::make('koordinat')
                            ->default('Lokasi Maps')
                            ->weight('bold')
                            ->size('sm')
                            ->color('primary'),
                        TextColumn::make('latitude')
                            ->prefix('Lat: ')
                            ->size('sm')
                            ->copyable(),
                        TextColumn::make('longitude')
                            ->prefix('Lng: ')
                            ->size('sm')
                            ->copyable(),
                    ])->grow(false)->space(1),
                ]),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 1,
                'xl' => 1,
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit Pengaturan'),
            ])
            ->paginated(false)
            ->toolbarActions([]);
    }
}
