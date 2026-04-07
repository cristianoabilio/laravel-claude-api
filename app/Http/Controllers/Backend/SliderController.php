<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = Slider::find($id);
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request)
    {
        $file = $request->file('image');

        $sliderId = $request->id;

        $slider = Slider::find($sliderId);
        $slider->title = $request->title;
        $slider->link = $request->link;
        $slider->description = $request->description;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(306, 618)->save(public_path('upload/sliders/' . $name));

            $slider->image = $name;
        }

        $slider->save();

        $notification = [
            'status' => 'success',
            'message' => 'slider updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('sliders.edit', $sliderId)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
