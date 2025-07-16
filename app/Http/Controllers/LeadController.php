<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLeadNotification;

class LeadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'level' => 'required|in:high_school,university,primary_school,adult_learning',
            'preference' => 'required|in:online,in_person,both',
            'message' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $lead = Lead::create($validator->validated());

        // Send email notification
        try {
            Mail::to('maryna@quest4knowledge.co.za')->send(new NewLeadNotification($lead));
        } catch (\Exception $e) {
            // Log the error but don't fail the lead creation
            \Log::error('Failed to send lead notification email: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your interest! We will contact you soon.',
            'lead_id' => $lead->id
        ], 201);
    }
}