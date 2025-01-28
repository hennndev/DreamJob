<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        $keep_me_logged_in = Cookie::get("keep_me_logged_in");
        return view("auth.login", [
            "title" => "Login",
            "keep_me_logged_in" => $keep_me_logged_in
        ]);
    }

    public function register() {
        return view("auth.register", [
            "title" => "Register"
        ]);
    }
    public function employer_register() {
        return view("employer.register", [
            "title" => "Employer Register"
        ]);
    }

    public function authenticate(Request $request) {
        $validated_data = $request->validate([
            "email" => "required|email:dns",
            "password" => "required|min:7"
        ]);
        $user = User::where("email", $validated_data["email"])->first();

        if(!$user) {
            return back()->withErrors([
                "error" => "Email not found"
            ])->withInput($request->only("email"));
        }

        if(!Hash::check($validated_data["password"], $user->password)) {
            return back()->withErrors([
                "error" => "Password incorrect"
            ])->withInput($request->only("email"));
        }

        if(Auth::attempt($validated_data)) {
            if($request->keep_me_logged_in) {
                Cookie::queue("keep_me_logged_in", $validated_data["email"], 10080);
            } else {
                Cookie::queue(Cookie::forget("keep_me_logged_in"));
            }
            $request->session()->regenerate();
            return redirect()->route("home");
        }

        return back()->withErrors([
            "error" => "Authentication failed"
        ])->withInput($request->only("mail"));
    }

    public function store(Request $request) {
        $validated_data = $request->validate([
            "name" => "required|min:3",
            "email" => "required|email:dns",
            "password" => "required|min:7|confirmed"
        ]);

        try {
            DB::beginTransaction();
            $new_candidate = Candidate::create();
            User::create([
                "name" =>$validated_data["name"],
                "email" => $validated_data["email"],
                "password" => Hash::make($validated_data["password"]),
                "userable_id" => $new_candidate->id,
                "userable_type" => Candidate::class
            ]);
            DB::commit();
            return back()->with("success", "Success create new candidate account. You can login now.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors([
                "error" => "Register failed. Please try again."
            ])->withInput($request->only(["email", "name"]));
        }
    }

    public function employer_store(Request $request) {
        $validated_data = $request->validate(([
            "name" => "required|string",
            "company_email" => "required|string|email:dns",
            "password" => "required|string|min:7|confirmed"
        ]));
        
        try {
            DB::beginTransaction();
            $new_employer = Employer::create();

            User::create([
                "name" => $validated_data["name"],
                "email" => $validated_data["company_email"],
                "password" => Hash::make($validated_data['password']),
                "userable_id" => $new_employer->id,
                "userable_type" => Employer::class
            ]);
            DB::commit();
            return back()->with("success", "Success create new employer account. You can login now.");
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors([
                "error" => "Register failed. Please try again."
            ])->withInput($request->only(["name", "email"]));
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
}
