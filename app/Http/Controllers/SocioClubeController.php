<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Src\Domain\Services\SocioClubeService;
use App\Src\Domain\Dto\SocioClubeDTO;
use App\Src\Infrastructure\Repositories\SocioClubeRepository;

class SocioClubeController extends Controller
{
    public $socioClubeService = null;

    public function __construct ()
    {
        $this->socioClubeService = new SocioClubeService(
            new SocioClubeRepository()
        );
    }

    /**
     * @OA\Post(
     *     path="/socioclube",
     *     tags={"socioclube"},
     *     summary="Salvar vínculo do sócio com o clube",
     *     description="Salvar vínculo do sócio com o clube",
     *     @OA\RequestBody(
     *       required=false,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="SocioId",
     *                   description="Registro do sócio",
     *                   type="string"
     *               ),
     *           ),
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                   property="ClubeId",
     *                   description="Registro do clube",
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
            $dados = $this->socioClubeService->save(new SocioClubeDTO(
                isset($request->SocioId) ? $request->SocioId : "",
                isset($request->ClubeId) ? $request->ClubeId : ""
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
     *     path="/socioclube",
     *     tags={"socioclube"},
     *     summary="buscar sócio e seus clubes",
     *     description="buscar sócio e seus clubes",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     )
     * )
     */
    public function get() {
        $dados = $this->socioClubeService->get();
        return response()->json($dados, 200);
    }
}
