<?php

namespace App\Src\Infrastructure\Repositories;

use App\Src\Domain\Interfaces\Repositories\IClubeRepository;
use App\Src\Domain\Entities\Clube;
use App\Models\Clube as ClubeModel;

class ClubeRepository implements IClubeRepository
{

    public function save(Clube $clube) : array
    {
        $error = [];
        try
        {

            $club = $clube->getDataSave();
            $arr = [
                "Nome" => $club["Nome"]
            ];
            $clubeModel = ClubeModel::create($arr);
            $clube->setId($clubeModel->Id);

        }
        catch (\Exception $e)
        {
            array_push($error, [
                "field" => "Nome",
                "description" => "Erro não identificado. Entre em contato com o Admistrador. [US-CODE: 001]"
            ]);

        }

        return [
            "clube" => $clube->getDataSave(),
            "error" => $error
        ];
    }

    public function delete(int $id) : array
    {

        $error = [];
        $clube = [];
        try
        {
            $clubeModel = ClubeModel::find($id);
            $clubeModel->delete();
            $clube = [
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
            "clube" => $clube,
            "error" => $error
        ];
    }

    public function findById(int $id) : ?array
    {
        $clube = [];
        $clubeModel = ClubeModel::where('Id', $id)->get()->all();
        if (!empty($clubeModel)) {
            $clubeModel = array_shift($clubeModel);
            $clube = [
                "Id" => $clubeModel->Id,
                "Nome" => $clubeModel->Nome
            ];
        }

        return $clube;
    }

    public function all() : array
    {
        $clubes = [];
        $clubesModel = ClubeModel::get()->all();
        foreach($clubesModel as $item) {
            array_push($clubes, [
                "Id"     => $item->Id,
                "Nome"   => $item->Nome
            ]);
        }

        return $clubes;
    }

    public function update(Clube $clube) : array
    {
        $error = [];

        try
        {
            $club = $clube->getDataSave();
            $clubeModel = ClubeModel::where('Id', $club["Id"])->get()->all();
            if (!empty($clubeModel)) {
                $clubeModel = array_shift($clubeModel);
                $clubeModel->Nome = $club["Nome"];
                $clubeModel->save();
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
            "clube"  => $clube->getDataSave(),
            "error" => $error
        ];
    }
}