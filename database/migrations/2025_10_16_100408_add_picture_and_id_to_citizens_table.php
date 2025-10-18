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
        Schema::table('citizens', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('email');
            $table->string('pcn')->nullable()->unique()->after('email');
            $table->string('national_id_photo')->nullable()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('citizens', function (Blueprint $table) {
            $table->dropColumn(['profile_picture', 'pcn', 'national_id_photo']);
        });
    }
};
