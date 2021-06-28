<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Src\Domain\Services\SocioService;
use App\Src\Domain\Dto\SocioDTO;
use App\Src\Infrastructure\Repositories\SocioRepository;

class SocioController extends Controller
{
    public $socioService = null;

    public function __construct ()
    {
        $this->socioService = new SocioService(
            new SocioRepository()
        );
    }

    /**
     * @OA\Post(
     *     path="/socio",
     *     tags={"socio"},
     *     summary="Salvar socio",
     *     description="Salvar socio",
     *     @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="Nome",
     *                   description="Nome do socio",
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
            $dados = $this->socioService->save(new SocioDTO(
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
     *     path="/socio/{id}",
     *     tags={"socio"},
     *     summary="buscar socio por id",
     *     description="buscar socio por id",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function getById(Request $request, int $id) {
        $dados = $this->socioService->getById($id);
        return response()->json($dados, 200);
    }

    /**
     * @OA\Get(
     *     path="/socio",
     *     tags={"socio"},
     *     summary="buscar socio por id",
     *     description="buscar socio por id",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function getAll() {
        $dados = $this->socioService->getAll();
        return response()->json($dados, 200);
    }

    /**
     * @OA\Put(
     *     path="/socio/{id}",
     *     tags={"socio"},
     *     summary="Atualizada dados do socio",
     *     description="Atualizada dados do socio",
     *     @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="Name",
     *                   description="Nome do socio",
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
            $dados = $this->socioService->update(new SocioDTO(
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
     *     path="/socio",
     *     tags={"socio"},
     *     summary="buscar todos os socios",
     *     description="buscar todos os socios",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function all() {
        $dados = $this->socioService->all();
        return response()->json($dados, 200);
    }

    /**
     * @OA\Delete(
     *     path="/socio/{id}",
     *     tags={"socio"},
     *     summary="Deletar socio por id",
     *     description="Deletar socio por id",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function delete(Request $request, int $id) {
        try {
            $dados = $this->socioService->delete($id);

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
