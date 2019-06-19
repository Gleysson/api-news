<?php

namespace App\Api;


class Message 
{
    
    public static function success($message, $data = [])
    {
        return [
            'error' => false,
            'message' => $message,
            'data' => $data
        ];
    }

    public static function error($message)
    {
        return [
            'error' => true,
            'message' => $message
        ];
    }

}
