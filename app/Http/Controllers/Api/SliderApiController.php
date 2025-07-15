<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderApiController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', true)->latest()->get();

        // Append full image URL
        $sliders = $sliders->map(function ($slider) {
            $slider->image_url = asset('storage/' . $slider->image);
            return $slider;
        });

        return response()->json([
            'success' => true,
            'data' => $sliders
        ]);
    }
}
