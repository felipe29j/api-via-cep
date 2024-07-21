<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function search($ceps)
    {
        $cepArray = explode(',', $ceps);
        $result = [];

        foreach ($cepArray as $cep) {
            $cep = str_replace('-', '', $cep);
            $response = Http::withOptions([
                'verify' => false, // Desativa a verificação SSL
            ])->get("https://viacep.com.br/ws/{$cep}/json/");
            
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
            }
        }

        return response()->json($result);
    }
}
