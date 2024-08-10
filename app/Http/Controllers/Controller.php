<?php

namespace App\Http\Controllers;

/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      title="Wallet",
 *      version="0.0.1",
 *      description="API documentation for Wallet project",
 *      @OA\Contact(
 *          email="iman_sp@yahoo.com"
 *      )
 *  ),
 *    @OA\Server(
 *      description="Web server",
 *      url=L5_SWAGGER_CONST_HOST
 *  ),
 *  @OA\PathItem(
 *      path="/"
 *  )
 * ),
 */
abstract class Controller
{
    protected function sendSuccess($message, $data, $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    protected function sendError($message, $data = '', $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
