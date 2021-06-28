<?php

namespace App\Src\Infrastructure\Repositories;

use App\Src\Domain\Interfaces\Repositories\ISocioClubeRepository;
use App\Src\Domain\Entities\SocioClube;
use App\Models\SocioClube as SocioClubeModel;
use App\Models\Socio as SocioModel;
use App\Models\Clube as ClubeModel;

class SocioClubeRepository implements ISocioClubeRepository
{

    public function save(SocioClube $socioClube) : array
    {
        $error = [];
        try
        {
            $arrSocioClube = $socioClube->getDataSave();
            SocioClubeModel::create($arrSocioClube);
        }
        catch (\Exception $e)
        {
            print_r($e->getMessage());
            array_push($error, [
                "field" => "Nome",
                "description" => "Erro não identificado. Entre em contato com o Admistrador. [US-CODE: 001]"
            ]);

        }

        return [
            "socio" => $socioClube->getDataSave(),
            "error" => $error
        ];
    }

    public function get() : array
    {

        $socios = [];
        $sociosModel = SocioModel::get()->all();
        foreach($sociosModel as $item) {
            $clubs = [];
            $clubes = SocioClubeModel::where('SocioId', $item->Id)->get()->all();
            foreach($clubes as $clube) {
                $clubeModel = ClubeModel::find($clube->ClubeId);
                array_push($clubs, $clubeModel->Nome);
            }
            array_push($socios, [
                "Id"     => $item->Id,
                "Nome"   => $item->Nome,
                "Clubes" => implode(", ", $clubs)
            ]);
        }

        return $socios;

    }
}