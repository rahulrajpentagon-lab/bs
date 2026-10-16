<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function show(): JsonResponse
    {
        return response()->json([
            'name' => config('company.name'),
            'tagline' => config('company.tagline'),
            'phone' => config('company.phone'),
            'email' => config('company.email'),
            'whatsapp' => config('company.whatsapp'),
            'location' => config('company.location'),
        ]);
    }
}
