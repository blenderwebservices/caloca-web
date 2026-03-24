<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->hintAction(
                        \Filament\Actions\Action::make('generateDescription')
                            ->icon('heroicon-o-sparkles')
                            ->label('Generar IA')
                            ->action(function (string $state, \Filament\Forms\Set $set) {
                                if (! $state) return;
                                
                                try {
                                    $response = \Laravel\Ai\Facades\Ai::generate("Genera una descripción profesional y breve (máximo 300 caracteres) para un proyecto titulado: {$state}");
                                    $set('description', $response);
                                } catch (\Exception $e) {
                                    \Filament\Notifications\Notification::make()
                                        ->title('Error de IA')
                                        ->body('Asegúrate de configurar tu API KEY en el archivo .env')
                                        ->danger()
                                        ->send();
                                }
                            })
                    ),
                \Filament\Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                \Filament\Forms\Components\Select::make('type')
                    ->options([
                        'app' => 'Aplicación',
                        'research' => 'Investigación',
                        'course' => 'Curso',
                        'project' => 'Proyecto',
                    ])
                    ->required()
                    ->default('project'),
                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'ongoing' => 'En curso',
                        'completed' => 'Completado',
                        'archived' => 'Archivado',
                    ])
                    ->required()
                    ->default('ongoing'),
                Toggle::make('is_featured')
                    ->label('Destacado')
                    ->default(false),
                TextInput::make('url')
                    ->label('URL del Proyecto')
                    ->url()
                    ->maxLength(255),
                FileUpload::make('image_path')
                    ->label('Imagen')
                    ->image()
                    ->directory('projects'),
            ]);
    }
}
