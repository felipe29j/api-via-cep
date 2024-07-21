<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Response;
use Exception;

class SearchController extends Controller
{
    public function search($ceps)
    {
        $cepArray = explode(',', $ceps);
        $result = [];

        try {
            foreach ($cepArray as $cep) {
                $cep = str_replace('-', '', $cep);
                $response = Http::withOptions([
                    'verify' => false, // Desativa a verificação SSL
                ])->get("https://viacep.com.br/ws/{$cep}/json/");
                
                if ($response->failed()) {
                    throw new Exception("Erro ao consultar o CEP {$cep}");
                }

                $data = $response->json();

                if (!isset($data['erro'])) {
                    $result[] = [
                        'cep' => $data['cep'] ? str_replace('-', '', $data['cep']) : '',
                        'label' => "{$data['logradouro']}, {$data['localidade']}",
                        'logradouro' => $data['logradouro'] ?? '',
                        'complemento' => $data['complemento'] ?? '',
                        'bairro' => $data['bairro'] ?? '',
                        'localidade' => $data['localidade'] ?? '',
                        'uf' => $data['uf'] ?? '',
                        'ibge' => $data['ibge'] ?? '',
                        'gia' => $data['gia'] ?? '',
                        'ddd' => $data['ddd'] ?? '',
                        'siafi' => $data['siafi'] ?? ''
                    ];
                } else {
                    $result[] = [
                        'cep' => $cep,
                        'error' => 'CEP não encontrado'
                    ];
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro ao processar a solicitação.',
                'message' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($result, 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
