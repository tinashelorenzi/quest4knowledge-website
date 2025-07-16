<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutor_applications', function (Blueprint $table) {
            $table->id();
            
            // Personal Information
            $table->string('prefix')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            
            // Address
            $table->string('street_address');
            $table->string('address_line')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            
            // Education
            $table->enum('education_level', ['High School', 'Bachelors', 'MSc(Masters)', 'PhD(Doctorate)', 'Other']);
            $table->json('tutoring_subjects'); // Store as JSON array
            $table->text('other_subjects')->nullable();
            
            // Files
            $table->string('matric_transcript')->nullable();
            $table->string('university_transcript')->nullable();
            $table->string('id_document');
            $table->string('police_clearance')->nullable();
            
            // Teaching Info
            $table->boolean('has_teaching_certification');
            $table->integer('teaching_experience_years');
            $table->boolean('can_do_online_tutoring');
            $table->json('teaching_methods'); // Online, In-Person, Hybrid
            $table->json('available_days'); // Days of week
            $table->json('available_times'); // Morning, Afternoon, Evening
            $table->boolean('flexible_scheduling');
            
            // Status
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_applications');
    }
};