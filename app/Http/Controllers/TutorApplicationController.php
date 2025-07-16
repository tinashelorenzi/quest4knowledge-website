<?php

namespace App\Http\Controllers;

use App\Models\TutorApplication;
use App\Mail\TutorApplicationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TutorApplicationController extends Controller
{
    public function create()
    {
        return view('tutor-application');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Personal Information
            'prefix' => 'nullable|string|max:10',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            
            // Address
            'street_address' => 'required|string|max:255',
            'address_line' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            
            // Education
            'education_level' => 'required|in:High School,Bachelors,MSc(Masters),PhD(Doctorate),Other',
            'tutoring_subjects' => 'required|array|min:1',
            'other_subjects' => 'nullable|string|max:1000',
            
            // Files
            'matric_transcript' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:8192',
            'university_transcript' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:8192',
            'id_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:8192',
            'police_clearance' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:8192',
            
            // Teaching Info
            'has_teaching_certification' => 'required|boolean',
            'teaching_experience_years' => 'required|integer|min:1|max:150',
            'can_do_online_tutoring' => 'required|boolean',
            'teaching_methods' => 'required|array|min:1',
            'available_days' => 'required|array|min:1',
            'available_times' => 'required|array|min:1',
            'flexible_scheduling' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Handle file uploads
            $fileData = [];
            
            if ($request->hasFile('matric_transcript')) {
                $fileData['matric_transcript'] = $request->file('matric_transcript')->store('tutor-applications/transcripts', 'public');
            }
            
            if ($request->hasFile('university_transcript')) {
                $fileData['university_transcript'] = $request->file('university_transcript')->store('tutor-applications/transcripts', 'public');
            }
            
            if ($request->hasFile('id_document')) {
                $fileData['id_document'] = $request->file('id_document')->store('tutor-applications/documents', 'public');
            }
            
            if ($request->hasFile('police_clearance')) {
                $fileData['police_clearance'] = $request->file('police_clearance')->store('tutor-applications/documents', 'public');
            }

            // Create the application
            $application = TutorApplication::create(array_merge(
                $request->except(['_token', 'matric_transcript', 'university_transcript', 'id_document', 'police_clearance']),
                $fileData
            ));

            // Send email notification
            Mail::to('maryna@quest4knowledge.co.za')->send(new TutorApplicationMail($application));

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your application! We will review it and get back to you soon.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your application. Please try again.'
            ], 500);
        }
    }
}