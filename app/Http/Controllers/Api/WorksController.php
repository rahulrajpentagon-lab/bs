<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class WorksController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'featured' => config('works.featured', []),
            'all' => config('works.all', []),
        ]);
    }
}
