<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;

class SubscriptionApiController extends Controller
{
    public function index(): JsonResponse
    {
        $subscriptions = Subscription::all();

        return response()->json([
            'status' => true,
            'message' => 'Subscription plans fetched successfully',
            'data' => $subscriptions
        ]);
    }
}
