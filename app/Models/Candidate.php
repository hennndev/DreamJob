<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ["tlp_number", "address", "country", "resume", "portfolio"];

    public function user() {
        return $this->morphOne(User::class, "userable");
    }
}
