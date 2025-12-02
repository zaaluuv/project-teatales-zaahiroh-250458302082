<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class UserWeeklyChart extends ChartWidget
{
    protected static ?string $heading = 'User Mingguan';

    protected int|string|array $columnSpan = 12;

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        Carbon::setLocale('en');

        // perulangan untuk 7 hari terakhir
        for ($i = 6; $i >= 0; $i--) {
            // menghitung tanggal hari ini dikurangi $i hari
            // Ambil tanggal hari ini, terus mundur sehari
            $date = Carbon::today()->subDays($i);

            // Tambahkan label hari dalam format singkat (Sen, Sel, Rab, etc.)
            $labels[] = $date->locale('en')->translatedFormat('D');

            // Hitung jumlah user yang terdaftar pada tasnggal tersebut
            // Kayak cari user yang tanggal daftar nya sama kayak $date, lalu dihitung jumlahnya
            $data[] = User::whereDate('created_at', $date)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'User Registrasi',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6',
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getHeight(): string
    {
        return 600;
    }

    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,

            'plugins' => [
                'legend' => [
                    'display' => true,
                    'positions' => 'buttom',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
