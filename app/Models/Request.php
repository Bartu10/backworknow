<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;


    protected $fillable = [
        'description',
        'status',
        'work_id',
        'recruiter_id',
        'user_id'
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function recruiter()
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
