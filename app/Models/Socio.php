<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{

    public $timestamps = false;

    Protected $primaryKey = "Id";

    protected $table = "socios";

    protected $fillable = [
        "Id", "Nome"
    ];

}