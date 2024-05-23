<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * Response
     */
    public function sendCollectionResponse($result, $success = true, $status = 200, $data = [])
    {
        return ($this->resource::collection($result))
            ->additional(array_merge(['success' => $success], $data))
            ->response()
            ->setStatusCode($status);
    }

    /**
     * Response
     */
    public function sendResponse($result, $success = true, $status = 200, $data = [])
    {
        if ($result instanceof \Illuminate\Database\Eloquent\Model) {
            return (new $this->resource($result))
                ->additional(array_merge(['success' => $success], $data))
                ->response()
                ->setStatusCode($status);
        }

        return response()->json(array_merge([
            'data' => [],
            'success' => $success
        ], $data))->setStatusCode($status);
    }
}