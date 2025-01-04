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
            'nombre' => 'adrian castro',          // Nombre del usuario
            'email' => 'juan.perez@example.com', // Correo electrónico
            'fecha_reserva' => '2025-01-15',     // Fecha de la reserva (formato YYYY-MM-DD)
            'hora_reserva' => '14:30',           // Hora de la reserva (formato HH:MM)
            'descripcion' => 'Reserva para cena', // Descripción del evento
            'ubicacion' => 'Restaurante ABC',    // Ubicación del evento
        ];

        // URL del webhook de Zapier
        $urlWebhook = 'https://hooks.zapier.com/hooks/catch/21200123/2zys123/';

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
