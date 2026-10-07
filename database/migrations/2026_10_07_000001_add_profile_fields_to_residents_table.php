<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female'])
                ->nullable()
                ->after('birth_date');

            $table->string('address', 500)
                ->nullable()
                ->after('gender');

            $table->string('occupation', 255)
                ->nullable()
                ->after('address');
        });
    }

    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn(['gender', 'address', 'occupation']);
        });
    }
};
