<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Materia extends Model
{
    protected $fillable = ['nombre_materia', 'descripcion', 'creditos'];

    /**
     * Relación muchos a muchos con Alumno
     * Una materia puede ser cursada por muchos alumnos
     */
    public function alumnos(): BelongsToMany
    {
        return $this->belongsToMany(Alumno::class, 'alumno_materia')
            ->withPivot('nota')
            ->withTimestamps();
    }
}
