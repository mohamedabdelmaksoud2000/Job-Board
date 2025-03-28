<?php

namespace App\Traits;

trait ResponseApi
{

    public function responseSuccess( $message , $data = null ,$code = 200)
    {
        $response = [
            'status'=>true,
            'message'=>$message,
        ];
        if($data)
        {
            $response['data'] = $data;
        }
        return response()->json($response,$code);
    }

    public function responseError( $message , $code )
    {
        return response()->json([
            'status'=>false,
            'message'=>$message,
        ],$code);
    }

    public function responseException($message)
    {
        return response()->json([
            'status'=>false,
            'message'=>$message,
        ],500);
    }
    
}