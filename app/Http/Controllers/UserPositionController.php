<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPositionRequest;
use Illuminate\Http\JsonResponse;

class UserPositionController extends Controller
{

    /**
     * Store users position in the session.
     *
     * @param  UserPostionRequest  $request
     * @return JsonResponse
     */
    public function store(UserPositionRequest $request): JsonResponse
    {
        session()->put(
            'position', [
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng')
            ]
        );

        return response()->json(
            ['position' => session()->get('position')],
            200
        );
    }
}
