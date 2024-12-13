<?php

namespace App\Filament\Widgets;

use App\Models\StudentQuiz;
use Filament\Widgets\ChartWidget;
use App\Models\Quiz;
use Carbon\Carbon;

class DashboardStudentTookQuizWidget extends ChartWidget
{
    protected static ?string $heading = 'Students Took Quiz';

    protected function getData(): array
    {
        $data = StudentQuiz::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Students who took quiz',
                    'data' => $data->pluck('count')->toArray(),
                ]
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bubble';
    }
}
