<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    use HasFactory;
    protected $table ='inscrito';

    protected $fillable = ["idcurso","idalumno","idmaestro","calificacion","namecurso","namecarrera","periodo","namealumno","namemaestro","asistencia"];
}
