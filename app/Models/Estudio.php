<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'especializacion',
        'institucion',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
