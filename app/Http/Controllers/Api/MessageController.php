<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Events\MessageCount;
use Exception;

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
            event(new MessageCount($r->unread));

            return [
                'status' => 200
            ];
        } 
        catch (Exception $e) 
        {
            return [
                'status' => 500
            ];
        }
    }
}
