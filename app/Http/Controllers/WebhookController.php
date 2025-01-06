<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{

    public function is_premium()
    {
        $token = request()->header('token');

        // login user

        return response()->json(true);
    }
    public function recibirReserva(Request $request)
    {
        $datos = [
            'nombre' => 'adrian castro',          // Nombre del usuario
            'email' => 'juan.perez@example.com', // Correo electrónico
            'fecha_reserva' => '2025-01-15',     // Fecha de la reserva (formato YYYY-MM-DD)
            'hora_reserva' => '14:30',           // Hora de la reserva (formato HH:MM)
            'descripcion' => 'Reserva para cena', // Descripción del evento
            'ubicacion' => 'Restaurante ABC',    // Ubicación del evento
        ];


        $data = $request;

        // URL del webhook de Zapier
        $urlWebhook_1 = $request->enpoint_1;
        $urlWebhook_2 = $request->enpoint_2;


        // Enviar datos con POST
        $response = Http::post($urlWebhook_1, $datos);

        // Verificar la respuesta
        if ($response->successful()) {
            return response()->json(['message' => 'Datos enviados con éxito']);
        } else {
            return response()->json(['error' => 'Error al enviar datos'], 500);
        }
    }
}
