<?php

namespace App\Filament\Resources\AiProviders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AiProviderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required(),
                Select::make('provider')
                    ->label('Proveedor IA')
                    ->options([
                        'openai' => 'OpenAI',
                        'gemini' => 'Google Gemini',
                        'anthropic' => 'Anthropic Claude',
                        'deepseek' => 'DeepSeek',
                        'groq' => 'Groq',
                        'ollama' => 'Ollama',
                        'mistral' => 'Mistral',
                        'azure' => 'Azure OpenAI',
                        'cohere' => 'Cohere',
                        'openrouter' => 'OpenRouter',
                    ])
                    ->required()
                    ->searchable(),
                TextInput::make('api_key')
                    ->label('API Key')
                    ->password()
                    ->revealable(),
                TextInput::make('base_url')
                    ->label('URL Base')
                    ->url(),
                TextInput::make('model')
                    ->label('Modelo')
                    ->required(),
                Toggle::make('is_default')
                    ->label('¿Establecer como prederminado?')
                    ->helperText('Esta configuración será la que use el Chatbot por defecto.')
                    ->default(false),
                Toggle::make('web_search_enabled')
                    ->label('Habilitar Búsqueda Web')
                    ->helperText('Permite al chatbot buscar información en tiempo real en internet.')
                    ->default(false),
            ]);
    }
}
