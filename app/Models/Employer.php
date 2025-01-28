<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $fillable = ["company_name", "company_address"];

    public function user() {
        return $this->morphOne(User::class, "userable");
    }
}
