<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{
    public function recibirReserva(Request $request)
    {
        $datos = [
            [
                "first_name" => "River",
                "last_name"  => "Green",
                "age"        => 27
            ],
            [
                "first_name" => "Alex",
                "last_name"  => "Smith",
                "age"        => 67
            ],
           
        ];

        // URL del webhook de Zapier
        $urlWebhook = 'https://hooks.zapier.com/hooks/catch/21160374/28qcxvo/';

        // Enviar datos con POST
        $response = Http::post($urlWebhook, $datos);

        // Verificar la respuesta
        if ($response->successful()) {
            return response()->json(['message' => 'Datos enviados con éxito']);
        } else {
            return response()->json(['error' => 'Error al enviar datos'], 500);
        }
    }
}
