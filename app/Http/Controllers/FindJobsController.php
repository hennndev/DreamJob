<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class FindJobsController extends Controller
{
    public function find_jobs() {
        $job_listings = JobListing::all();
        return view("find_jobs", [
            "title" => "Find jobs",
            "data" => $job_listings
        ]);
    }


    public function job_detail($id) {
        $job = JobListing::find($id);
        return view("job_detail", [
            "title" => "Job detail"
        ]);
    }
}
