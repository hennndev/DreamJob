<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FindJobsController;
use App\Http\Controllers\JobListingsController;
use App\Http\Middleware\EmployerAuth;
use App\Models\JobListing;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $job_listings = JobListing::all();
    return view('home', [
        "title" => "Home",
        "data" => $job_listings
    ]);
})->name("home");

Route::controller(AuthController::class)->group(function() {
    Route::get("/login", "login")->name("login")->middleware(["guest"]);
    Route::get("/register", "register")->name("register")->middleware(["guest"]);
    Route::get("/employer/register", "employer_register")->name("employer.register")->middleware(["guest"]);
    Route::post("login", "authenticate")->name("auth.authenticate")->middleware(["guest"]);
    Route::post("register", "store")->name("auth.store")->middleware(["guest"]);
    Route::post("employer/register", "employer_store")->name("auth.employer_store")->middleware(["guest"]);
    Route::post("logout", "logout")->name("auth.logout")->middleware(["auth"]);
});

Route::prefix("employer")->middleware(EmployerAuth::class)->group(function() {
    Route::get("dashboard", function() {
        return view("employer.dashboard.index", [
            "title" => "Dashboard"
        ]);
    })->name("employer.dashboard");
    Route::controller(JobListingsController::class)->group(function() {
        Route::get("job-listings", "index")->name("employer.job_listings");
        Route::get("job-listings/post-job", "add")->name("employer.job_listings.add");
        Route::post("job-listings", "store")->name("employer.job_listings.store");
        Route::get("job-listings/edit-job/{id}", "edit")->name("employer.job_listings.edit");
        Route::put("job-listings/{id}", "update")->name("employer.job_listings.update");
        Route::delete("job-listings/{id}", "destroy")->name("employer.job_listings.destroy");
    });
}); 


Route::controller(FindJobsController::class)->group(function() {
    Route::get("/find-jobs", "find_jobs")->name("find_jobs");
    Route::get("/find-jobs/jobs/{id}", "job_detail")->name("job_detail");
});