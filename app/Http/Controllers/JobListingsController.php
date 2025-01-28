<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingsController extends Controller
{
    public function index() {
        return view("employer.job_listings.index", [
            "title" => "Job Listings"
        ]);
    }

    public function add() {
        return view("employer.job_listings.add", [
            "title" => "Add job"
        ]);
    }

    public function edit($id) {
        return view("employer.job_listings.edit", [
            "title" => "Edit job"
        ]);
    }

    public function store(Request $request) {
        // $job_skills = json_decode($request->input('job_skills_requirement'), true);
        $validated_data = $request->validate([
            "job_position" => "required|string|min:3",
            "job_type" => "required|string",
            "job_salary" => "integer|required",
            "job_salary_type" => "required|string",
            "job_description" => "required|string", 
        ]);
        $user = Auth::user();
        JobListing::create([
            "job_position" => $validated_data["job_position"],
            "job_type" => $validated_data["job_type"],
            "job_salary" => $validated_data["job_salary"],
            "job_salary_type" => $validated_data["job_salary_type"],
            "job_description" => $validated_data["job_description"],
            "job_skills_requirement" => $request->job_skills_requirement,
            "employer_id" => $user->userable->id
        ]);
        return redirect()->route("employer.job_listings");
    }

    public function update(Request $request) {

    }

    public function destroy($id) {

    }
}
