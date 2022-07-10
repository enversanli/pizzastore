<?php

namespace App\Support;

class ResponseMessage
{
    public static function returnData($status = true, $data = null, $message = null)
    {

        if (!$message)
            $message = 'Success';

        return (object)[
            'message' => $message,
            'data' => $data,
            'status' => $status
        ];

    }

    public static function success($message = null, $data = null)
    {
        if (!$message)
            $message = 'Success';

        return response()->json([
            'message' => $message,
            'data' => $data
        ], 200);
    }

    public static function failed($message = null, $error = null, $code = 400)
    {
        if (!$message)
            $message = 'Something went wrong.';

        return response()->json([
            'message' => $message,
            'error' => $error,
            'code' => $code
        ], $code);
    }

}
