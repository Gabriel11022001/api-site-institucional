<?php

namespace App\Service;

use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BannerService
{

    public function cadastrarBanner(Request $requisicao) {

        try {
            $validador = Validator::make($requisicao->all(), [
                'imagem_fundo' => 'required|image',
                'titulo_banner' => 'required|string|unique:banners',
                'texto_banner' => 'required|string',
                'url_link_banner' => 'required|string'
            ],
            [
                'imagem_fundo.required' => 'Informe a imagem do banner!',
                'imagem_fundo.image' => 'O documento deve ser uma imagem!',
                'titulo_banner.required' => 'Informe o título do banner!',
                'titulo_banner.string' => 'O título do banner deve ser um texto!',
                'titulo_banner.unique' => 'Já existe um banner cadastrado com esse título!',
                'texto_banner.required' => 'Informe o texto descritivo do banner!',
                'texto_banner.string' => 'O texto descritivo do banner deve ser um texto!',
                'url_link_banner.required' => 'Informe o link para onde o banner redireciona!',
                'url_link_banner.string' => 'O link para onde o banner redireciona deve ser um texto!'
            ]);

            if ($validador->fails()) {

                return response()
                    ->json([
                        'msg' => 'Ocorreram erros de validação de dados!',
                        'dados' => $validador->errors(),
                        'ok' => false
                    ], 200);
            }

            // realizando o upload da imagem do banner
            $caminho = $requisicao->imagem_fundo->store('banners');
            $banner = new Banner();
            $banner->titulo_banner = $requisicao->titulo_banner;
            $banner->texto_banner = $requisicao->texto_banner;
            $banner->url_link_banner = $requisicao->url_link_banner;
            $banner->imagem_fundo = $caminho;

            if (!$banner->save()) {

                return response()
                    ->json([
                        'msg' => 'Ocorreu um erro ao tentar-se cadastrar o banner!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Banner cadastrado com sucesso!',
                    'dados' => $banner,
                    'ok' => true
                ], 201);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se cadastrar o banner!' . $e->getMessage(),
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function obterImagemBanner($idBanner) {

        try {
            $banner = Banner::find($idBanner);

            if (!$banner) {

                return response()
                    ->json([
                        'msg' => 'Não existe um banner cadastrado no banco de dados com esse id!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            $imagemBannerDb = $banner->imagem_fundo;
            $imagemBanner = Storage::get($imagemBannerDb);

            if (!$imagemBanner) {

                return response()
                    ->json([
                        'msg' => 'Não existe uma imagem salva nesse caminho!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            return response($imagemBanner)->header('Content-Type', 'image/png');
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se obter a imagem do banner!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function buscarTodosBannersAtivos() {

        try {
            $banners = Banner::where('status', true)
                ->get()
                ->toArray();

            if (count($banners) === 0) {

                return response()
                    ->json([
                        'msg' => 'Não existem banners ativos cadastrados no banco de dados!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Banners encontrados com sucesso!',
                    'dados' => $banners,
                    'ok' => true
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se buscar os banners ativos!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function buscarTodosBanners() {

        try {
            $banners = Banner::all();

            if (count($banners) === 0) {

                return response()
                    ->json([
                        'msg' => 'Não existem banners cadastrados no banco de dados!',
                        'dados' => [],
                        'ok' => false
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Banners encontrados com sucesso!',
                    'dados' => $banners,
                    'ok' => true
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se buscar todos os banners!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }
        
    }
}