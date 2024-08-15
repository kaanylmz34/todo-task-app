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
        Schema::table('tasks', function (Blueprint $table) {
            // end_date, start_date'den önceki bir tarih değerini alamaz.
            // bunun için CHECK constraint tanımlanmıştır
            DB::statement('ALTER TABLE tasks ADD CONSTRAINT end_date_check CHECK (end_date >= start_date)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('end_date_check');
        });
    }
};
