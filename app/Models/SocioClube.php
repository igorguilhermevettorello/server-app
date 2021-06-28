<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocioClube extends Model
{

    public $timestamps = false;

    protected $table = "socios_clubes";

    protected $fillable = [
        "SocioId", "ClubeId"
    ];

}