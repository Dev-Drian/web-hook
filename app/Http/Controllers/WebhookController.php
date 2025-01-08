<?php

namespace App\Http\Controllers;

use App\Models\Prueba;
use App\Models\UserDetail;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebhookController extends Controller
{

    public function is_premium(Request $request)
    {
        $id = Auth()->user()->id;
        $userIp = $request->header('X-User-IP');
        $cant_reques = 0;

        $userDetails = UserDetail::where('user_id', $id)->get();

        $uniqueIps = $userDetails->pluck('ip')->unique();
        if ($uniqueIps->count() >= 2 && !$uniqueIps->contains($userIp)) {
            return response()->json(['error' => 'Ya tienes muchas cuentas registradas'], 400);
        }

        $existingDetail = $userDetails->where('ip', $userIp)->first();
        if ($existingDetail) {
            $existingDetail->canti_request += 1;
            $existingDetail->save();
        } else {
            UserDetail::create([
                'user_id' => $id,
                'ip' => $userIp,
                'canti_request' => $cant_reques
            ]);
        }

        return response()->json(true);
    }
    public function recibirReserva(Request $request)
    {

        // Obtener el cuerpo del request
        $body = $request->getContent();
        $data = json_decode($body, true);

        // Guardar la data en la base de datos
        $prueba = new Prueba();
        $prueba->data = json_encode($data);
        $prueba->save();


        // Extraer los endpoints del JSON recibido
        $endpoint_1 = $data['endpoint_1'] ?? null;
        $endpoint_2 = $data['endpoint_2'] ?? null;
        $datos = $data['data'] ?? null;

        // Realizar las solicitudes a los endpoints si existen
        if ($endpoint_1) {
            $response1 = Http::post($endpoint_1, $datos);
        }

        if ($endpoint_2) {
            $response2 = Http::post($endpoint_2, $datos);
        }

        return response()->json([
            'message' => 'Data procesada y enviada correctamente.',
            'status_1' => $response1->status() ?? null,
            'status_2' => $response2->status() ?? null,
        ]);
        // Verificar la respuesta
    }
}
