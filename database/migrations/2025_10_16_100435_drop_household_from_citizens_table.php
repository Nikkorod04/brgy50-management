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
            $table->dropForeign(['household_id']);
        });
        
        Schema::table('citizens', function (Blueprint $table) {
            $table->dropColumn('household_id');
        });
        
        Schema::dropIfExists('households');
    }

    public function down(): void
    {
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->timestamps();
        });
        
        Schema::table('citizens', function (Blueprint $table) {
            $table->foreignId('household_id')->nullable()->constrained();
        });
    }
};
