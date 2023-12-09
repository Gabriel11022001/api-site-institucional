<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\RedeSocialController;
use App\Http\Controllers\TipoContatoController;
use Illuminate\Support\Facades\Route;

Route::post('/tipo-contato', [ TipoContatoController::class, 'cadastrarTipoContato' ]);
Route::post('/contato', [ ContatoController::class, 'cadastrarContato' ]);
Route::post('/rede-social', [ RedeSocialController::class, 'cadastrarRedeSocial' ]);
Route::post('/banner', [ BannerController::class, 'cadastrarBanner' ]);
Route::delete('/rede-social/{id}', [ RedeSocialController::class, 'deletarRedeSocial' ]);
Route::get('/tipo-contato', [ TipoContatoController::class, 'buscarTodosTiposContato' ]);
Route::get('/tipo-contato/{id}', [ TipoContatoController::class, 'buscarTipoContatoPeloId' ]);
Route::get('/contato/ativos', [ ContatoController::class, 'buscarContatosAtivos' ]);
Route::get('/rede-social', [ RedeSocialController::class, 'buscarTodasRedesSociais' ]);
Route::get('/banner', [ BannerController::class, 'buscarTodosBannersAtivos' ]);
Route::get('/banner/imagem/{idBanner}', [ BannerController::class, 'obterImagemBanner' ]);