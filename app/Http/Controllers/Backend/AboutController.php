<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AboutPageUpdateRequest;
use App\Models\About;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::get()->first();

        return view('admin.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutPageUpdateRequest $request)
    {
        $file = $request->file('image');

        $aboutId = $request->id;

        $about = About::find($aboutId);
        $about->title = $request->title;
        $about->description = $request->description;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(60, 60)->save(public_path('upload/about/' . $name));

            $about->image = $name;
        }

        $about->save();

        $notification = [
            'status' => 'success',
            'message' => 'About page updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('about.index')->with($notification);
    }
}
