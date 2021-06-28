<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clube extends Model
{

    public $timestamps = false;

    Protected $primaryKey = "Id";

    protected $table = "clubes";

    protected $fillable = [
        "Id", "Nome"
    ];

}
