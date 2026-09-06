<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('house_residents', function (Blueprint $table) {
            $table->index(
                ['resident_id', 'is_active'],
                'house_residents_resident_active_index'
            );
        });
    }

    public function down(): void
    {
        Schema::table('house_residents', function (Blueprint $table) {
            $table->dropIndex(
                'house_residents_resident_active_index'
            );
        });
    }
};
