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
        Schema::table('delivery_records', function (Blueprint $table) {
            $table->date('medical_certificate_expiry')->nullable()->after('observations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_records', function (Blueprint $table) {
            $table->dropColumn('medical_certificate_expiry');
        });
    }
};
