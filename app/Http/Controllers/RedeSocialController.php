<?php

namespace App\Http\Controllers;

use App\Service\RedeSocialService;
use Illuminate\Http\Request;

class RedeSocialController extends Controller
{
    private $redeSocialService;

    public function __construct(RedeSocialService $redeSocialService) {
        $this->redeSocialService = $redeSocialService;
    }

    public function cadastrarRedeSocial(Request $requisicao) {

        return $this->redeSocialService->cadastrarRedeSocial($requisicao);
    }

    public function deletarRedeSocial($id) {

        return $this->redeSocialService->deletarRedeSocial($id);
    }

    public function buscarTodasRedesSociais() {

        return $this->redeSocialService->buscarTodasRedesSociais();
    }
}
