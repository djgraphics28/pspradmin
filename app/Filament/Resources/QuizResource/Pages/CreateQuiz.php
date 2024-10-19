<?php

namespace App\Filament\Resources\QuizResource\Pages;

use App\Models\Quiz;
use Filament\Actions;
use App\Filament\Resources\QuizResource;
use Filament\Resources\Pages\CreateRecord;

class CreateQuiz extends CreateRecord
{
    protected static string $resource = QuizResource::class;

    protected function handleRecordCreation(array $data): Quiz
    {
        // Create the quiz record.
        $quiz = Quiz::create($data);

        // Generate questions based on the number of items.
        $numberOfItems = $data['number_of_items'];

        for ($i = 1; $i <= $numberOfItems; $i++) {
            $quiz->questions()->create([
                'question_text' => "Question $i",
                // Add additional fields if necessary, like 'correct_answer' or 'options'.
            ]);
        }

        return $quiz;
    }
}
