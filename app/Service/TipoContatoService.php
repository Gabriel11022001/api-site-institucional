<?php

namespace App\Service;

use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoContatoService
{

    public function cadastrarTipoContato(Request $requisicao) {

        try {
            $validador = Validator::make($requisicao->all(), [
                'descricao' => 'required|unique:tipo_contatos'
            ],
            [   
                'descricao.required' => 'Informe a descrição do tipo de contato!',
                'unique' => 'Informe outra descrição para o tipo de contato!'
            ]);

            if ($validador->fails()) {

                return response()
                    ->json([
                        'msg' => 'Ocorreram erros de validação de dados!',
                        'dados' => $validador->errors(),
                        'ok' => false
                    ], 200);
            }

            $tipoContato = new TipoContato();
            $tipoContato->descricao = $requisicao->descricao;

            if ($tipoContato->save()) {

                return response()
                    ->json([
                        'msg' => 'Tipo de contato cadastrado com sucesso!',
                        'dados' => $tipoContato,
                        'ok' => true
                    ], 201);
            } else {

                return response()
                    ->json([
                        'msg' => 'Ocorreu um erro ao tentar-se cadastrar o tipo de contato!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se cadastrar o tipo de contato!' . $e->getMessage(),
                    'dados' => null,
                    'ok' => false
                ], 200);
        }
        
    }

    public function buscarTodosTiposContato() {

        try {
            $tiposContato = TipoContato::all();

            if (count($tiposContato) > 0) {

                return response()
                    ->json([
                        'msg' => 'Tipos de contato encontrados com sucesso!',
                        'dados' => $tiposContato,
                        'ok' => true
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Não existem tipos de contato cadastrados no banco de dados!',
                    'dados' => [],
                    'ok' => false
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se buscar os tipos de contato!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function buscarTipoContatoPeloId($id) {

        try {

            if (empty($id)) {

                return response()
                    ->json([
                        'msg' => 'Informe o id do contato!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            $tipoContato = TipoContato::find($id);

            if (!$tipoContato) {

                return response()
                    ->json([
                        'msg' => 'Não existe um tipo de contato cadastrado com o id informado!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Tipo de contato encontrado com sucesso!',
                    'dados' => $tipoContato,
                    'ok' => true
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se buscar o tipo de contato pelo id!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }
}