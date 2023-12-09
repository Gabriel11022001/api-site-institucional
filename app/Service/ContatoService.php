<?php

namespace App\Service;

use App\Models\Contato;
use App\Models\TipoContato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContatoService
{

    public function cadastrarContato(Request $requisicao) {

        try {
            $validador = Validator::make($requisicao->all(), [
                'contato' => 'required|unique:contatos',
                'tipo_contato_id' => 'required|numeric|min:1'
            ],
            [
                'contato.required' => 'Informe a descrição do contato!',
                'contato.unique' => 'Informe outra descrição para o contato!',
                'tipo_contato_id.required' => 'Informe o tipo de contato!',
                'tipo_contato_id.numeric' => 'O id do tipo de contato deve ser um valor numérico!',
                'tipo_contato_id.min' => 'O id do tipo de contato deve ser maior que 0!'
            ]);

            if ($validador->fails()) {

                return response()
                    ->json([
                        'msg' => 'Ocorreram erros de validação de dados!',
                        'dados' => $validador->errors(),
                        'ok' => false
                    ], 200);
            }

            $tipoContato = TipoContato::find($requisicao->tipo_contato_id);

            if (!$tipoContato) {

                return response()
                    ->json([
                        'msg' => 'Não existe um tipo de contato cadastrado no banco de dados com esse id!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            $contato = new Contato();
            $contato->contato = $requisicao->contato;
            $contato->tipo_contato_id = $requisicao->tipo_contato_id;

            if ($contato->save()) {

                return response()
                    ->json([
                        'msg' => 'Contato cadastrado com sucesso!',
                        'dados' => $contato,
                        'ok' => true
                    ], 201);
            }

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se cadastrar o contato!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se cadastrar o contato!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function buscarContatosAtivos() {
        
        try {       
            $contatosAtivos = Contato::where('status', true)
                ->get()
                ->toArray();
            
            if (count($contatosAtivos) === 0) {

                return response()
                    ->json([
                        'msg' => 'Não existem contatos ativos cadastrados no banco de dados!',
                        'dados' => null,
                        'ok' => false
                    ], 200);
            }

            return response()
                ->json([
                    'msg' => 'Existem contatos ativos cadastrados no banco de dados!',
                    'dados' => $contatosAtivos,
                    'ok' => true
                ], 200);
        } catch (Exception $e) {

            return response()
                ->json([
                    'msg' => 'Ocorreu um erro ao tentar-se buscar os contatos ativos!',
                    'dados' => null,
                    'ok' => false
                ], 200);
        }

    }

    public function editarContato(Request $requisicao) {
        
    }

}