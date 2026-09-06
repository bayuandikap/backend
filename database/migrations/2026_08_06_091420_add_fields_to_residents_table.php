<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->string('ktp_photo')->nullable();

            $table->enum('resident_status', [
                'permanent',
                'contract'
            ])->default('permanent');

            $table->boolean('is_married')
                ->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn([
                'ktp_photo',
                'resident_status',
                'is_married',
            ]);
        });
    }
};
