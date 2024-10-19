<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use App\Models\Answer; // Import the Answer model
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question_text')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),

                // Define the Answers sub-form
                Forms\Components\Repeater::make('answers') // Use a Repeater for dynamic answer input
                    ->columnSpanFull()
                    ->relationship('answers') // This assumes you have a relationship defined in your Question model
                    ->schema([
                        Forms\Components\TextInput::make('answer_text')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Checkbox::make('is_correct')
                            ->label('Correct Answer'),
                    ])
                    ->columns(2) // Adjust columns for layout
                    // ->createItemButtonLabel('Add Answer') // Button label to add answers
                    // ->getDeleteItemButtonLabel('Remove Answer'), // Use getDeleteItemButtonLabel for button label
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question_text')
            ->columns([
                Tables\Columns\TextColumn::make('question_text'),

               // Add a custom column for displaying the number of answers
               Tables\Columns\TextColumn::make('answers') // This will display related answers
               ->label('Choices')
               ->formatStateUsing(fn ($record) => $record->answers()->count() . ' choices'), // Count the number of answers
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
