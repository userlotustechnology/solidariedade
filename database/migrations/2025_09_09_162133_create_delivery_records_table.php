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
        Schema::create('delivery_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_id')->constrained()->onDelete('cascade');
            $table->foreignId('participant_id')->constrained()->onDelete('cascade');
            $table->timestamp('delivered_at');
            $table->string('document_verified'); // Documento apresentado
            $table->text('observations')->nullable();
            $table->foreignId('delivered_by')->constrained('users'); // Quem entregou
            $table->timestamps();

            // Evitar duplicação de entrega para o mesmo participante na mesma entrega
            $table->unique(['delivery_id', 'participant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_records');
    }
};
