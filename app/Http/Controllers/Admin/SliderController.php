<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.manage_app.sliders', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'image' => $path,
            'status' => true,
        ]);

        return back()->with('success', 'Slider created successfully.');
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);
            $slider->image = $request->file('image')->store('sliders', 'public');
        }

        $slider->save();
        return back()->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();
        return back()->with('success', 'Slider deleted successfully.');
    }

    public function toggleStatus(Slider $slider)
    {
        $slider->status = !$slider->status;
        $slider->save();
        return response()->json(['status' => $slider->status]);
    }
}
