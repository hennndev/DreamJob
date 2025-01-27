<?php

use App\Http\Controllers\AuthController;
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