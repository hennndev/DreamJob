<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    protected $fillable = ["job_position", "job_type", "job_salary", "job_salary_type", "job_skills_requirement", "job_description", "employer_id"];
}
