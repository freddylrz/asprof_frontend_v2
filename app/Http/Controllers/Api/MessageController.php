<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Events\MessageCount;
use App\Events\paymentStatus;
use Exception;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function index(Request $r)
    {
        try 
        {
            $arrayData = [
                'room_id'    => (int) $r->room_id,
                'user_id'    => (int) $r->user_id,
                'user_name'  => $r->user_name,
                'message'    => $r->message,
                'created_at' => now(),
            ];

            event(new MessageSent($r->room_id, $arrayData));
            event(new MessageCount($r->room_id, $r->unread));

            return [
                'status' => 200
            ];
        }
        catch (Exception $e) 
        {   
            \Log::error($e);
          
            return [
                'status' => 500
            ];
        }
    }

    public function timer(Request $r)
    {
        try 
        {   
            // Contoh endTime diberikan sebagai string
            $endTime = date('Y-m-d H:i:s', strtotime($r->get('expire_date')));
            $endTime = Carbon::parse($endTime); // Konversi ke Carbon

            // return $endTime;
            
            return response()->stream(function () use ($endTime) {
                while (Carbon::now()->lessThanOrEqualTo($endTime)) {
                    // Hitung sisa waktu dalam detik
                    $remainingSeconds = $endTime->diffInSeconds(Carbon::now());

                    $remainingSeconds = $remainingSeconds * -1;

                    // Format ke HH:MM:SS
                    $hours = str_pad(floor($remainingSeconds / 3600), 2, "0", STR_PAD_LEFT);
                    $minutes = str_pad(floor(($remainingSeconds % 3600) / 60), 2, "0", STR_PAD_LEFT);
                    $seconds = str_pad($remainingSeconds % 60, 2, "0", STR_PAD_LEFT);

                    // Kirim data ke klien
                    echo json_encode([
                        'timer' => "$hours:$minutes:$seconds",
                        'is_finished' => false,
                    ]) . "\n";

                    \Log::info(json_encode([
                        'timer' => "$hours:$minutes:$seconds",
                        'is_finished' => false,
                    ]));

                    ob_flush();
                    flush();

                    sleep(1);
                }

                // Kirim akhir countdown
                echo json_encode([
                    'timer' => "00:00:00",
                    'is_finished' => true,
                ]) . "\n";

                ob_flush();
                flush();
            }, 200, [
                'Content-Type' => 'application/json',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
            ]);
        }
        catch (Exception $e) 
        {   
            \Log::error($e);
          
            return [
                'status' => 500
            ];
        }
    }

    public function paymentStatus(Request $r)
    {
        try
        {   
            event(new paymentStatus($r->room_id, $r->is_paid));

            return [
                'status' => 200
            ];
        }
        catch (Exception $e) 
        {   
            \Log::error($e);
          
            return [
                'status' => 500
            ];
        }
    }
}
