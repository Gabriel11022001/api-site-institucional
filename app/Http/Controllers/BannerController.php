<?php

namespace App\Http\Controllers;

use App\Service\BannerService;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService) {
        $this->bannerService = $bannerService;
    }

    public function cadastrarBanner(Request $requisicao) {

        return $this->bannerService->cadastrarBanner($requisicao);
    }

    public function buscarTodosBannersAtivos() {

        return $this->bannerService->buscarTodosBannersAtivos();
    }

    public function obterImagemBanner($idBanner) {

        return $this->bannerService->obterImagemBanner($idBanner);
    }
}
