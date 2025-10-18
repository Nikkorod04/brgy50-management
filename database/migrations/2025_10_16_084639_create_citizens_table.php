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
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable(); // Jr., Sr., III, etc.
            
            // Contact Information
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('barangay')->default('Barangay 50');
            $table->string('city')->default('Tacloban City');
            $table->string('province')->default('Leyte');
            $table->string('postal_code')->nullable();
            
            // Demographics
            $table->date('birthdate');
            $table->integer('age')->nullable(); // Calculated from birthdate
            $table->enum('gender', ['Male', 'Female', 'Other', 'Prefer not to say'])->nullable();
            $table->enum('civil_status', ['Single', 'Married', 'Divorced', 'Widowed', 'Separated', 'Annulled'])->nullable();
            
            // Special Categories
            $table->boolean('is_pwd')->default(false); // Person with Disability
            $table->boolean('is_senior_citizen')->default(false); // Senior Citizen (60+)
            $table->boolean('is_lgbtq')->default(false); // LGBTQ+ Community
            $table->boolean('is_solo_parent')->default(false); // Solo Parent
            
            // Additional Information
            $table->string('occupation')->nullable();
            $table->string('educational_attainment')->nullable();
            $table->text('notes')->nullable();
            
            // Household Information (optional feature)
            $table->unsignedBigInteger('household_id')->nullable();
            
            // Metadata
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->default('active'); // active, inactive, deceased
            
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index('last_name');
            $table->index('first_name');
            $table->index('gender');
            $table->index('civil_status');
            $table->index('is_pwd');
            $table->index('is_senior_citizen');
            $table->index('is_lgbtq');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizens');
    }
};
