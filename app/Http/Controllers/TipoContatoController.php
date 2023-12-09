<?php

namespace App\Http\Controllers;

use App\Service\TipoContatoService;
use Illuminate\Http\Request;

class TipoContatoController extends Controller
{
    private $tipoContatoService;

    public function __construct(TipoContatoService $tipoContatoService) {
        $this->tipoContatoService = $tipoContatoService;
    }

    public function cadastrarTipoContato(Request $requisicao) {

        return $this->tipoContatoService->cadastrarTipoContato($requisicao);
    }

    public function buscarTodosTiposContato() {

        return $this->tipoContatoService->buscarTodosTiposContato();
    }

    public function buscarTipoContatoPeloId($id) {

        return $this->tipoContatoService->buscarTipoContatoPeloId($id);
    }
}
