<?php

namespace App\Traits;

use Illuminate\Support\MessageBag;

trait ApiTrait {
    /**
     * Add error to response
     * @param $key
     * @param $value
     * @return MessageBag
     */
    public function addError($key, $value)
    {
        $errors = new MessageBag();
        $errors->add($key, $value);
        return $errors;
    }

    /**
     * Create default success message
     * @return \Illuminate\Http\JsonResponse
     */
    public function createApiSuccessMessage()
    {
        return response()->json([
            'success' => true
        ], 200);
    }

    /**
     * Create default error message
     * @param $reason
     * @return \Illuminate\Http\JsonResponse
     */
    public function createApiErrorMessage($reason)
    {
        return response()->json([
            'success' => false,
            'message' => $reason
        ]);
    }

    /**
     * Create usual answer
     * @param array $params
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnJson(array $params = [], int $status = 200)
    {
        return response()->json($params, $status, [],JSON_NUMERIC_CHECK);
    }
}