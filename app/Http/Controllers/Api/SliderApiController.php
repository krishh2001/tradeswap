<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderApiController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->latest()->get()->map(function ($slider) {
            return [
                'id' => $slider->id,
                'image_url' => asset('storage/' . $slider->image),
                'created_at' => $slider->created_at->toDateTimeString(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $sliders
        ]);
    }
}
