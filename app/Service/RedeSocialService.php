<?php

namespace App\Service;

use App\Models\RedeSocial;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RedeSocialService
{

    public function cadastrarRedeSocial(Request $requisicao) {

        try {
            $validador = Validator::make($requisicao->all(), [
                'nome' => 'required|unique:redes_sociais',
                'url' => 'required'
            ],  
            [
                'nome.required' => 'Informe o nome da rede social!',
                'nome.unique' => 'Já existe uma rede social cadastrada com esse nome!',
                'url.required' => 'Informe a url para a rede social!'
            ]);

            if ($validador->fails()) {

                return response()
                    ->json([
                        'msg' => 'Ocorreram erros de validação de dados!',
                        'dados' => $validador->errors(),
                        'ok' => false
                    ], 200);
            }

            $redeSocial = new RedeSocial();
            $redeSocial->nome = $requisicao->nome;
            $redeSocial->url = $requisicao->url;

            if (!$redeSocial->save()) {

                return response()
                    ->json([
                        'msg' => 'Ocorreu um erro ao tentar-se cadastrar a rede social!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Rede social cadastrada com sucesso!',
                    'dados' => $redeSocial,
                    'ok' => true
                ], 201);
        } catch (Exception $e) {
            
            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se cadastrar a rede social!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function buscarTodasRedesSociais() {

        try {
            $redesSociais = RedeSocial::all();

            if (count($redesSociais) === 0) {

                return response()
                    ->json([
                        'msg' => 'Não existem redes sociais cadastradas no banco de dados!',
                        'dados' => [],
                        'ok' => false
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Redes sociais encontradas com sucesso!',
                    'dados' => $redesSociais,
                    'ok' => true
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se buscar as redes sociais!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function editarRedeSocial() {

    }

    public function deletarRedeSocial($id) {

        try {

            if (empty($id)) {

                return response()
                    ->json([
                        'msg' => 'Informe o id da rede social!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            $redeSocial = RedeSocial::find($id);

            if (!$redeSocial) {

                return response()
                    ->json([
                        'msg' => 'Não existe uma rede social cadastrada com esse id!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            if ($redeSocial->delete()) {

                return response()
                    ->json([
                        'msg' => 'Rede social deletada com sucesso!',
                        'dados' => null,
                        'ok' => true
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se deletar a rede social!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se deletar a rede social!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }
}