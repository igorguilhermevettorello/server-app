<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Src\Domain\Services\ClubeService;
use App\Src\Domain\Dto\ClubeDTO;
use App\Src\Infrastructure\Repositories\ClubeRepository;

class ClubeController extends Controller
{
    public $clubeService = null;

    public function __construct ()
    {
        $this->clubeService = new ClubeService(
            new ClubeRepository()
        );
    }

    /**
     * @OA\Post(
     *     path="/clube",
     *     tags={"clube"},
     *     summary="Salvar clube",
     *     description="Salvar clube",
     *     @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="Nome",
     *                   description="Nome do clube",
     *                   type="string"
     *               ),
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Mensagem de erros",
     *     )
     * )
     */
    public function save(Request $request) {
        $error = [];
        try {
            $dados = $this->clubeService->save(new ClubeDTO(
                null,
                isset($request->Nome)   ? $request->Nome   : "",
            ));

            if (!empty($dados["error"])) {
                $error = $dados["error"];
                throw (new Exception);
            }

            return response()->json($dados, 200);

        } catch (\Exception $e) {
            if (empty($error)) {
                array_push($error, [
                    "field" => "Error",
                    "description" => $e->getMessage()
                ]);
            }

            return response()->json($error, 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/clube/{id}",
     *     tags={"clube"},
     *     summary="buscar clube por id",
     *     description="buscar clube por id",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function getById(Request $request, int $id) {
        $dados = $this->clubeService->getById($id);
        return response()->json($dados, 200);
    }

    /**
     * @OA\Get(
     *     path="/clube",
     *     tags={"clube"},
     *     summary="buscar clube por id",
     *     description="buscar clube por id",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function getAll() {
        $dados = $this->clubeService->getAll();
        return response()->json($dados, 200);
    }

    /**
     * @OA\Put(
     *     path="/clube/{id}",
     *     tags={"clube"},
     *     summary="Atualizada dados do clube",
     *     description="Atualizada dados do clube",
     *     @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="Name",
     *                   description="Nome do clube",
     *                   type="string"
     *               )
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Mensagem de erros",
     *     )
     * )
     */
    public function update(Request $request, int $id) {
        $error = [];
        try {
            $dados = $this->clubeService->update(new ClubeDTO(
                $id,
                isset($request->Nome)   ? $request->Nome   : "",
            ));

            if (!empty($dados["error"])) {
                $error = $dados["error"];
                throw (new Exception);
            }

            return response()->json($dados, 200);

        } catch (\Exception $e) {
            if (empty($error)) {
                array_push($error, [
                    "field" => "Error",
                    "description" => $e->getMessage()
                ]);
            }

            return response()->json($error, 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/clube",
     *     tags={"clube"},
     *     summary="buscar todos os clubes",
     *     description="buscar todos os clubes",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function all() {
        $dados = $this->clubeService->all();
        return response()->json($dados, 200);
    }

    /**
     * @OA\Delete(
     *     path="/clube/{id}",
     *     tags={"usuário"},
     *     summary="Deletar usuário por id",
     *     description="Deletar usuário por id",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function delete(Request $request, int $id) {
        try {
            $dados = $this->clubeService->delete($id);

            if (!empty($dados["error"])) {
                $error = $dados["error"];
                throw (new Exception);
            }

            return response()->json($dados, 200);

        } catch (\Exception $e) {
            if (empty($error)) {
                array_push($error, [
                    "field" => "Error",
                    "description" => $e->getMessage()
                ]);
            }

            return response()->json($error, 400);
        }
    }
}
