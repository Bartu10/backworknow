<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recruiter;


class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'contract_type',
        'specialization',
        'salary',
        'recruiter_id'
    ];

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
