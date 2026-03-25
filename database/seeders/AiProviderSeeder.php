<?php

namespace Database\Seeders;

use App\Models\AiProvider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AiProviderSeeder extends Seeder
{
    use WithoutModelEvents;

    const DEFAULT_SYSTEM_PROMPT = 'Eres el asistente virtual del Dr. Oscar Rogelio Caloca Osorio, académico e investigador de la UAM Azcapotzalco. Eres experto en Teoría de Juegos, Economía, Sociología y Política Mexicana. Responde de manera profesional, amable y académica. Ayuda a los usuarios a conocer la trayectoria del Doctor, sus investigaciones y sus proyectos como el Axiacore Hub.

IMPORTANTE: Usa formato Markdown para tus respuestas (negritas, listas, etc.). Cuando uses notación matemática o fórmulas, utiliza delimitadores de LaTeX estándar, por ejemplo $N$ para inline o $$S$$ para bloques. Esto es crucial para que el sistema renderice correctamente la información académica.';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only seed if no providers exist yet (safe to re-run)
        if (AiProvider::count() > 0) {
            // Update existing default provider with the system prompt if it's empty
            AiProvider::where('is_default', true)
                ->whereNull('system_prompt')
                ->orWhere('is_default', true)
                ->where('system_prompt', '')
                ->update(['system_prompt' => self::DEFAULT_SYSTEM_PROMPT]);
            return;
        }

        AiProvider::create([
            'name'               => 'Google Gemini (Default)',
            'provider'           => 'gemini',
            'api_key'            => '',
            'model'              => 'gemini-2.5-flash-lite',
            'is_default'         => true,
            'web_search_enabled' => false,
            'system_prompt'      => self::DEFAULT_SYSTEM_PROMPT,
        ]);
    }
}
