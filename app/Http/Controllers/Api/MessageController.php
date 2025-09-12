<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Events\MessageCount;
use App\Events\paymentStatus;
use App\Events\RequestStatus;
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
    try {
        $endTime = Carbon::parse($r->get('expire_date'));

        return response()->stream(function () use ($endTime) {
            while (Carbon::now()->lessThanOrEqualTo($endTime)) {
                $remainingSeconds = Carbon::now()->diffInSeconds($endTime, false);

                $hours   = str_pad(floor($remainingSeconds / 3600), 2, "0", STR_PAD_LEFT);
                $minutes = str_pad(floor(($remainingSeconds % 3600) / 60), 2, "0", STR_PAD_LEFT);
                $seconds = str_pad($remainingSeconds % 60, 2, "0", STR_PAD_LEFT);

                echo json_encode([
                    'timer'       => "$hours:$minutes:$seconds",
                    'is_finished' => false,
                ]) . "\n";

                ob_flush();
                flush();
                sleep(1);
            }

            // Countdown selesai
            echo json_encode([
                'timer'       => "00:00:00",
                'is_finished' => true,
            ]) . "\n";

            ob_flush();
            flush();

            exit; // ini penting biar Laravel gak nambahin HTML
        }, 200, [
            'Content-Type'  => 'application/json',
            'Cache-Control' => 'no-cache',
            'Connection'    => 'keep-alive',
        ]);
    } catch (Exception $e) {
        \Log::error($e);
        return response()->json(['status' => 500], 500);
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

    public function reuestStatus(Request $r)
    {
        try
        {   
            $arrayData = [
                'reqId'      => $r->reqId,
                'statusId'   => $r->statusId,
                'statusDesc' => $r->statusDesc,
            ];

            event(new RequestStatus($arrayData));

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
