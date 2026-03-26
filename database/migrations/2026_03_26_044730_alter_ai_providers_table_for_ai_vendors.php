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
            $table->dropColumn(['provider', 'model']);
            $table->foreignId('ai_vendor_id')->nullable()->after('name')->constrained()->nullOnDelete();
            $table->foreignId('ai_model_id')->nullable()->after('ai_vendor_id')->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ai_providers', function (Blueprint $table) {
            $table->dropForeign(['ai_vendor_id']);
            $table->dropForeign(['ai_model_id']);
            $table->dropColumn(['ai_vendor_id', 'ai_model_id']);
            $table->string('provider')->nullable();
            $table->string('model')->nullable();
        });
    }
};
