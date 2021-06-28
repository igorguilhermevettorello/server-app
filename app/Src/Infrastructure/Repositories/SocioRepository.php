<?php

namespace App\Src\Infrastructure\Repositories;

use App\Src\Domain\Interfaces\Repositories\ISocioRepository;
use App\Src\Domain\Entities\Socio;
use App\Models\Socio as SocioModel;

class SocioRepository implements ISocioRepository
{

    public function save(Socio $socio) : array
    {

        $error = [];
        try
        {
            $arrSocio = $socio->getDataSave();
            $arr = [
                "Nome" => $arrSocio["Nome"]
            ];
            $socioModel = SocioModel::create($arr);
            $socio->setId($socioModel->Id);

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
            "socio" => $socio->getDataSave(),
            "error" => $error
        ];
    }

    public function delete(int $id) : array
    {

        $error = [];
        $socio = [];
        try
        {
            $socioModel = SocioModel::find($id);
            $socioModel->delete();
            $socio = [
                "id" => $id
            ];

        }
        catch (\Exception $e)
        {
            array_push($error, [
                "field" => "Nome",
                "description" => "Erro não identificado. Entre em contato com o Admistrador. [US-CODE: 001]"
            ]);

        }

        return [
            "socio" => $socio,
            "error" => $error
        ];
    }

    public function findById(int $id) : ?array
    {
        $socio = [];
        $socioModel = SocioModel::where('Id', $id)->get()->all();
        if (!empty($socioModel)) {
            $socioModel = array_shift($socioModel);
            $socio = [
                "Id" => $socioModel->Id,
                "Nome" => $socioModel->Nome
            ];
        }

        return $socio;
    }

    public function all() : array
    {
        $socios = [];
        $sociosModel = SocioModel::get()->all();
        foreach($sociosModel as $item) {
            array_push($socios, [
                "Id"     => $item->Id,
                "Nome"   => $item->Nome
            ]);
        }

        return $socios;
    }

    public function update(Socio $socio) : array
    {
        $error = [];

        try
        {
            $arrSocio = $socio->getDataSave();
            $socioModel = SocioModel::where('Id', $arrSocio["Id"])->get()->all();
            if (!empty($socioModel)) {
                $socioModel = array_shift($socioModel);
                $socioModel->Nome = $arrSocio["Nome"];
                $socioModel->save();
            } else {
                array_push($error, [
                    "field" => "Code",
                    "description" => "Código não identificado."
                ]);
            }
        }
        catch (\Exception $e)
        {
            array_push($error, [
                "field" => "Nome",
                "description" => "Erro não identificado. Entre em contato com o Admistrador. [US-CODE: 002]"
            ]);

        }

        return [
            "socio"  => $socio->getDataSave(),
            "error" => $error
        ];
    }
}