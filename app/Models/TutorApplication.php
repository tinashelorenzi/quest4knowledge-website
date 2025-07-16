<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'street_address',
        'address_line',
        'city',
        'state',
        'zip_code',
        'education_level',
        'tutoring_subjects',
        'other_subjects',
        'matric_transcript',
        'university_transcript',
        'id_document',
        'police_clearance',
        'has_teaching_certification',
        'teaching_experience_years',
        'can_do_online_tutoring',
        'teaching_methods',
        'available_days',
        'available_times',
        'flexible_scheduling',
        'status',
        'notes',
    ];

    protected $casts = [
        'tutoring_subjects' => 'array',
        'teaching_methods' => 'array',
        'available_days' => 'array',
        'available_times' => 'array',
        'has_teaching_certification' => 'boolean',
        'can_do_online_tutoring' => 'boolean',
        'flexible_scheduling' => 'boolean',
    ];

    public function getFullNameAttribute()
    {
        return trim("{$this->prefix} {$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}