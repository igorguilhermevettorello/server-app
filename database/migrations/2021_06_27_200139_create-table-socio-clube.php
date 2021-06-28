<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSocioClube extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE TABLE socios_clubes (
                SocioId INT,
                ClubeId INT,
                CONSTRAINT sc_socio_id FOREIGN KEY (SocioId) REFERENCES socios (id),
                CONSTRAINT sc_clube_id FOREIGN KEY (ClubeId) REFERENCES clubes (id)
            ) ENGINE = InnoDB;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clubes');
    }
}
