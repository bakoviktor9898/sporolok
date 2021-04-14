<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __invoke(Request $request)
    {
        $status = auth()->user()
            ? 'authorized'
            : 'unauthorized';

        return response()->json([
            'status' => $status,
            'user' => auth()->user()
        ], 200);
    }
}
