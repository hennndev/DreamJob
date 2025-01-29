<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobListingsController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $query_search = $request->query("q");
        $job_listings = JobListing::where("employer_id", $user->userable->id)
                                ->where("job_position", "LIKE", "%" . $query_search . "%")
                                ->orWhere("job_type", "LIKE", "%" . $query_search . "%")
                                ->orWhere("job_salary", "LIKE", "%" . $query_search . "%")->get()->sortByDesc("createdAt");
        return view("employer.job_listings.index", [
            "title" => "Job Listings",
            "data" => $job_listings
        ]);
    }

    public function add() {
        return view("employer.job_listings.add", [
            "title" => "Add job"
        ]);
    }

    public function edit($id) {
        $job = JobListing::find($id);
        return view("employer.job_listings.edit", [
            "title" => "Edit job",
            "data" => $job
        ]);
    }

    public function store(Request $request) {
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

    public function update(Request $request, $id) {
        $validated_data = $request->validate([
            "job_position" => "required|string|min:3",
            "job_type" => "required|string",
            "job_salary" => "integer|required",
            "job_salary_type" => "required|string",
            "job_description" => "required|string", 
        ]);
        JobListing::where("id", $id)->update(array_merge(
            $validated_data,
            ["job_skills_requirement" => $request->job_skills_requirement]
        ));

        return redirect()->route("employer.job_listings");
    }

    public function destroy($id) {
        JobListing::where("id", $id)->delete();
        return response()->json([
            "message" => "Job has deleted"
        ]);
    }
}
