<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function trueResponse($message, $data = null, $meta = null)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
            'meta'    => $meta,
        ], Response::HTTP_OK);
    }

    protected function falseResponse($message, $errors = null, $meta = null)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'data'    => $errors,
            'meta'    => $meta,
        ], Response::HTTP_OK);
    }
}
