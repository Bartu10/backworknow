<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Recruiter extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'company',
        'password'
    ];

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function request()
    {
        return $this->hasMany(Request::class);
    }
    public function chats(){
        return $this->hasMany(Chat::class);
    }

}
