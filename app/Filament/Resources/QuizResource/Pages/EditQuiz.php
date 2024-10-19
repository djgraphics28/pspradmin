<?php

namespace App\Filament\Resources\QuizResource\Pages;

use App\Models\Quiz;
use Filament\Actions;
use App\Filament\Resources\QuizResource;
use Filament\Resources\Pages\EditRecord;

class EditQuiz extends EditRecord
{
    protected static string $resource = QuizResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate($record, array $data): Quiz
    {
        // Update the quiz record.
        $quiz = parent::handleRecordUpdate($record, $data);

        // Get the updated number of items.
        $updatedNumberOfItems = $data['number_of_items'];

        // Get the current number of questions associated with the quiz.
        $currentNumberOfQuestions = $quiz->questions()->count();

        // If the updated number is greater, add new questions.
        if ($updatedNumberOfItems > $currentNumberOfQuestions) {
            $difference = $updatedNumberOfItems - $currentNumberOfQuestions;

            for ($i = 1; $i <= $difference; $i++) {
                $quiz->questions()->create([
                    'question_text' => "Question " . ($currentNumberOfQuestions + $i),
                ]);
            }
        }
        // If the updated number is less, remove the excess questions.
        elseif ($updatedNumberOfItems < $currentNumberOfQuestions) {
            $difference = $currentNumberOfQuestions - $updatedNumberOfItems;

            // Delete the latest questions (from the end).
            $quiz->questions()
                ->latest()
                ->take($difference)
                ->get()
                ->each(fn($question) => $question->delete());
        }

        return $quiz;
    }
}
