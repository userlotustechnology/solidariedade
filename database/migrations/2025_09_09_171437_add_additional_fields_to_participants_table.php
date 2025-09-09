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
        Schema::table('participants', function (Blueprint $table) {
            $table->string('marital_status')->nullable()->after('gender'); // Estado civil
            $table->string('address_complement')->nullable()->after('address'); // Complemento do endereço
            $table->boolean('receives_government_benefit')->default(false)->after('observations'); // Recebe benefício do governo
            $table->string('government_benefit_type')->nullable()->after('receives_government_benefit'); // Qual benefício recebe
            $table->enum('employment_status', ['empregado', 'desempregado', 'aposentado', 'pensionista', 'autonomo'])->nullable()->after('government_benefit_type'); // Situação trabalhista
            $table->string('workplace')->nullable()->after('employment_status'); // Local de trabalho
            $table->boolean('has_documents')->default(false)->after('workplace'); // Possui documentos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn([
                'marital_status',
                'address_complement',
                'receives_government_benefit',
                'government_benefit_type',
                'employment_status',
                'workplace',
                'has_documents'
            ]);
        });
    }
};
