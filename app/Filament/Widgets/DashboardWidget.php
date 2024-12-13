<?php

namespace App\Filament\Widgets;

use App\Models\Instructor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\Lesson;
use App\Models\Quiz;

class DashboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Total number of registered students')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),

            Stat::make('Total Instructors', Instructor::count())
                ->description('Total number of instructors')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total Lessons', Lesson::count())
                ->description('Total number of lessons created')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('warning'),

            Stat::make('Total Quizzes', Quiz::count())
                ->description('Total number of quizzes')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('danger'),
        ];
    }
}
