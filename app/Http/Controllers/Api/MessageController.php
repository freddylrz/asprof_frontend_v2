<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Exception;

class MessageController extends Controller
{
    public function index(Request $r)
    {   
        try
        {            
            $arrayData = [
                'room_id'    => $r->room_id,
                'user_id'    => 1,
                'message'    => $r->message,
                'created_at' => now(),
            ];

            event(new MessageSent($r->room_id, $arrayData));

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
