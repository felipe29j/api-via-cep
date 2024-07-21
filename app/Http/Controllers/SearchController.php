<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function search($ceps)
    {
        $cepArray = explode(',', $ceps);
    
        $enderecos = [];
    
        foreach ($cepArray as $cep) {
            $response = Http::withOptions([
                'verify' => false, // Desativa a verificação SSL
            ])->get("https://viacep.com.br/ws/{$cep}/json/");
    
            if ($response->successful()) {
                $enderecos[] = $response->json();
            }
        }
    
        return response()->json($enderecos);
    }
    
}

