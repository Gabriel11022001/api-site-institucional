<?php

namespace App\Http\Controllers;

use App\Service\ContatoService;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    private $contatoService;

    public function __construct(ContatoService $contatoService) {
        $this->contatoService = $contatoService;
    }

    public function cadastrarContato(Request $requisicao) {

        return $this->contatoService->cadastrarContato($requisicao);
    }

    public function buscarContatosAtivos() {

        return $this->contatoService->buscarContatosAtivos();
    }
}
