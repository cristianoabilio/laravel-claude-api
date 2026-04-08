<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ClarifyUpdateRequest;
use App\Models\Clarify;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ClarifiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clarifies = Clarify::latest()->get();
        return view('admin.clarifies.index', compact('clarifies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clarifies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClarifyUpdateRequest $request)
    {
        $file = $request->file('image');

        $clarify = new clarify();
        $clarify->title = $request->title;
        $clarify->description = $request->description;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(302, 618)->save(public_path('upload/clarifies/' . $name));

            $clarify->image = $name;
        }

        $clarify->save();

        $notification = [
            'status' => 'success',
            'message' => 'Clarify added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('clarifies.all')->with($notification);
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
        $clarify = Clarify::find($id);
        return view('admin.clarifies.edit', compact('clarify'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClarifyUpdateRequest $request)
    {
        $file = $request->file('image');

        $clarifyId = $request->id;

        $clarify = Clarify::find($clarifyId);
        $clarify->title = $request->title;
        $clarify->description = $request->description;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(302, 618)->save(public_path('upload/clarifies/' . $name));

            $clarify->image = $name;
        }

        $clarify->save();

        $notification = [
            'status' => 'success',
            'message' => 'Clarify updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('clarifies.edit', $clarifyId)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clarify = Clarify::find($id);

        $clarify->delete();

        $notification = [
            'message' => 'clarify deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
