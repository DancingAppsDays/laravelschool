<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Profesor extends Model
{
    use HasFactory;

   // protected $table ='profesors';
   protected $fillable = ["fullName","password","email", "birthday"];
}
