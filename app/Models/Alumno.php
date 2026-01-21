<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Alumno extends Model
{
    protected $fillable = ['nombre', 'email', 'edad'];

    /**
     * Relación muchos a muchos con Materia
     * Un alumno puede cursar muchas materias
     */
    public function materias(): BelongsToMany
    {
        return $this->belongsToMany(Materia::class, 'alumno_materia')
            ->withPivot('nota')
            ->withTimestamps();
    }
}
