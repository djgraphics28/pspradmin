<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Instructor;
use Filament\Tables\Table;
use App\Mail\AccountCreated;
use Filament\Resources\Resource;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InstructorResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\InstructorResource\RelationManagers;

class InstructorResource extends Resource
{
    protected static ?string $model = Instructor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canAccess(): bool
    {
        return auth()->user()->is_admin;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->columnSpanFull()
                    ->collection('avatars'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('avatar')
                    ->collection('avatars'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('createAccount')
                    ->form([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required(),
                    ])
                    ->action(function (Instructor $record, array $data) {
                        $password = strtolower(explode(' ', $record->name)[1]); // Get lowercase of last name
            
                        // Create user account
                        $user = \App\Models\User::create([
                            'name' => $record->name,
                            'is_admin' => false,
                            'email' => $data['email'],
                            'password' => bcrypt($password)
                        ]);

                        // Update instructor with user_id
                        $record->update([
                            'user_id' => $user->id
                        ]);

                        // Send verification email with credentials
                        \Mail::to($data['email'])->send(new AccountCreated($user, $password));

                        // Show notification
                        Notification::make()
                            ->success()
                            ->title('Account created successfully')
                            ->send();
                    })
                    ->icon('heroicon-o-user-plus')
                    ->label(fn(Instructor $record) => $record->user_id ? 'Reset Account' : 'Create Account')
                    ->hidden(fn(Instructor $record) => $record->user_id !== null),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstructors::route('/'),
            'create' => Pages\CreateInstructor::route('/create'),
            'edit' => Pages\EditInstructor::route('/{record}/edit'),
        ];
    }
}
