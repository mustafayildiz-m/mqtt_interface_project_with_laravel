<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyDeviceSerialNumber
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $serialNumberHeader = $request->header('X-Device-Serial-Number');

        $serial_no = base64_decode($serialNumberHeader);

        $device = Device::where(['serial_no' => $serial_no]);

        if ($device->count() === 0) {
            return response()->json(['error' => 'Geçersiz cihaz seri numarası.'], 401);
        }
        return $next($request);
    }
}
