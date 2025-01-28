<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobListingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        "title" => "Home"
    ]);
})->name("home");

// auth
Route::controller(AuthController::class)->group(function() {
    Route::get("/login", "login")->name("login")->middleware(["guest"]);
    Route::get("/register", "register")->name("register")->middleware(["guest"]);
    Route::get("/employer/register", "employer_register")->name("employer.register")->middleware(["guest"]);
    Route::post("login", "authenticate")->name("auth.authenticate")->middleware(["guest"]);
    Route::post("register", "store")->name("auth.store")->middleware(["guest"]);
    Route::post("employer/register", "employer_store")->name("auth.employer_store")->middleware(["guest"]);
    Route::post("logout", "logout")->name("auth.logout")->middleware(["auth"]);
});

Route::prefix("employer")->group(function() {
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
    });
}); 