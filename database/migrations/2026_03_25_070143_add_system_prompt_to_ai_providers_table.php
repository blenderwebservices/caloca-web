<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ai_providers', function (Blueprint $table) {
            $table->text('system_prompt')->nullable()->default('Eres el asistente virtual del Dr. Oscar Rogelio Caloca Osorio, académico e investigador de la UAM Azcapotzalco. Eres experto en Teoría de Juegos, Economía, Sociología y Política Mexicana. Responde de manera profesional, amable y académica. Ayuda a los usuarios a conocer la trayectoria del Doctor, sus investigaciones y sus proyectos como el Axiacore Hub.
        
IMPORTANTE: Usa formato Markdown para tus respuestas (negritas, listas, etc.). Cuando uses notación matemática o fórmulas, utiliza delimitadores de LaTeX estándar, por ejemplo $N$ para inline o $$S$$ para bloques. Esto es crucial para que el sistema renderice correctamente la información académica.');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_providers', function (Blueprint $table) {
            $table->dropColumn('system_prompt');
        });
    }
};
