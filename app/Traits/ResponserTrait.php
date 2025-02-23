<?php


namespace App\Traits;


use Illuminate\Http\Response;

trait ResponserTrait
{

    public static function allResponse($status, $code=Response::HTTP_OK, $message="", $data=null, $url=null){

        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'code'=>$code,
            'data'=>$data,
            'url'=>$url,
        ]);
    }

    public static function collectionResponse($status='success', $code=200, $collection=null){
        return response()->json([
            'status'=>$status,
            'code'=>$code,
            'data'=>$collection,
        ]);
    }

    public static function singleResponse($data, $status='success', $code=200, $message=null){
        return response()->json([
            'status'=>$status,
            'code'=>$code,
            'message'=>$message,
            'data'=>$data,
        ]);
    }

    public static function validationResponse($status='validation', $code=400, $errors=[]){
        $message = null;
        foreach ($errors as $error){
            if(!empty($error)){
                foreach ($error as $errorItem){
                    $message .=  $errorItem .'<br/> ';
                }
            }
        }
        return response()->json([
            'status'=>$status,
            'code'=>$code,
            'message'=>$message,
        ]);
    }

}
