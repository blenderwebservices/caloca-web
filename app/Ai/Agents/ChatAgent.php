<?php

namespace App\Ai\Agents;

use App\Models\AiProvider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Promptable;
use Laravel\Ai\Providers\Tools\WebSearch;
use Stringable;

class ChatAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    public function provider(): string
    {
        return config('ai.default');
    }

    public function model(): ?string
    {
        return config("ai.providers.{$this->provider()}.model");
    }

    protected array $history = [];

    /**
     * Set the conversation history.
     */
    public function withHistory(array $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        // Try to load from the active AI provider record in the database
        $dbPrompt = AiProvider::where('is_default', true)
            ->value('system_prompt');

        $instructions = $dbPrompt ?: 'Eres el asistente virtual del Dr. Oscar Rogelio Caloca Osorio, académico e investigador de la UAM Azcapotzalco. Eres experto en Teoría de Juegos, Economía, Sociología y Política Mexicana. Responde de manera profesional, amable y académica. Ayuda a los usuarios a conocer la trayectoria del Doctor, sus investigaciones y sus proyectos como el Axiacore Hub.

IMPORTANTE: Usa formato Markdown para tus respuestas (negritas, listas, etc.). Cuando uses notación matemática o fórmulas, utiliza delimitadores de LaTeX estándar, por ejemplo $N$ para inline o $$S$$ para bloques. Esto es crucial para que el sistema renderice correctamente la información académica.';

        if (config("ai.providers.{$this->provider()}.web_search_enabled")) {
            $instructions .= ' Tienes la capacidad de realizar búsquedas en internet; ANTES de afirmar o negar eventos recientes (como el fallecimiento de figuras públicas o noticias actuales), DEBES usar la herramienta de búsqueda para verificar la información.';
        }

        return $instructions;
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return $this->history;
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        if (config("ai.providers.{$this->provider()}.web_search_enabled")) {
            return [
                new WebSearch,
            ];
        }

        return [];
    }
}
