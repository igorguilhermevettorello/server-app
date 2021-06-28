<?php

namespace App\Src\Domain\Services;

use App\Src\Domain\FactoryMethods\SocioClubeFactory;
use App\Src\Domain\Dto\SocioClubeDTO;
use App\Src\Infrastructure\Repositories\SocioClubeRepository;

class SocioClubeService
{
    private SocioClubeRepository $socioClubeRepository;

    public function __construct (
        SocioClubeRepository $socioClubeRepository
    ) {
        $this->socioClubeRepository = $socioClubeRepository;
    }

    public function save(SocioClubeDTO $socioClubeDTO) : array
    {

        $dados = SocioClubeFactory::validateRegisterSocioClube($socioClubeDTO);

        if (!empty($dados["error"])) {
            return $dados;
        }

        $dados = $this->socioClubeRepository->save($dados["socioClube"]);

        return $dados;
    }

    public function get() : array
    {
        return $this->socioClubeRepository->get();
    }
}