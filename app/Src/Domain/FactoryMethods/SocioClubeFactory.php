<?php

namespace App\Src\Domain\FactoryMethods;

use App\Src\Domain\Dto\SocioClubeDTO;
use App\Src\Domain\Entities\SocioClube;

abstract class AbstractSocioClubeFactoryMethod {
    abstract static function validateRegisterSocioClube(SocioClubeDTO $socioClubeDTO) : array;
}

class SocioClubeFactory extends AbstractSocioClubeFactoryMethod {

    public static function validateRegisterSocioClube(SocioClubeDTO $socioClubeDTO) : array
    {
        $error = [];
        $socioClube = null;

        if (empty($socioClubeDTO->SocioId) || is_null($socioClubeDTO->SocioId)) {
            array_push($error, [
                "field" => "SocioId",
                "description" => "Campo sócio é obrigatório."
            ]);
        }

        if (empty($socioClubeDTO->ClubeId) || is_null($socioClubeDTO->ClubeId)) {
            array_push($error, [
                "field" => "ClubeId",
                "description" => "Campo clube é obrigatório."
            ]);
        }

        if (empty($error)) {
            $socioClube = SocioClube::getInstance(
                $socioClubeDTO->SocioId,
                $socioClubeDTO->ClubeId
            );
        }

        return [
            "socioClube" => $socioClube,
            "error" => $error
        ];
    }
}
