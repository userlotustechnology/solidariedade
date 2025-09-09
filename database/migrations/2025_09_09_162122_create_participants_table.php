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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document_type'); // CPF, RG, etc
            $table->string('document_number')->unique();
            $table->date('birth_date');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state', 2);
            $table->string('zip_code');
            $table->enum('gender', ['M', 'F', 'Other'])->nullable();
            $table->integer('family_members')->default(1);
            $table->decimal('monthly_income', 10, 2)->nullable();
            $table->text('observations')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('registered_at')->useCurrent();
            $table->foreignId('registered_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
