<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string("job_position");
            $table->json("job_skills_requirement");
            $table->enum("job_type", ["full-time", "part-time", "freelance", "internship"]);
            $table->string("job_description");
            $table->integer("job_salary");
            $table->enum("job_salary_type", ["fixed", "negotiable"]);
            $table->unsignedBigInteger("employer_id");
            $table->timestamps();


            $table->foreign("employer_id")->references("id")->on("employers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
