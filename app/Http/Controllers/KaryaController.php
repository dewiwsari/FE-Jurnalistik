<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class KaryaController extends Controller
{
    public function index()
    {
        $response = Http::get('https://jurnalsmandas.web.id/api/karya');

        if ($response->successful()) {
            $data = $response->json();
        } else {
            $data = ['data' => []];
        }

        return view('karya', [
            'karyas' => $data['data']
        ]);
    }
}