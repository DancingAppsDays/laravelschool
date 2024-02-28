<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Alumno extends Model
{
    use HasFactory;
    //protected $table ='alumnos';
     protected $fillable = ["fullName","password","email", "birthday"];
   // protected $guarded = [];

   protected $hidden = [
    'remember_token',
   ];

   public function getAuthPassword()
   {
    return $this->password;
   }
}
