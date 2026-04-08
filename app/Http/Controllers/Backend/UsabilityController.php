<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UsabilityStoreRequest;
use App\Http\Requests\Backend\UsabilityUpdateRequest;
use App\Models\Usability;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class UsabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usabilities = Usability::latest()->get();

        return view('admin.usabilities.index', compact('usabilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsabilityStoreRequest $request)
    {
        $file = $request->file('image');

        $usability = new Usability();
        $usability->title = $request->title;
        $usability->link = $request->link;
        $usability->youtube = $request->youtube;
        $usability->description = $request->description;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(302, 618)->save(public_path('upload/usabilities/' . $name));

            $usability->image = $name;
        }

        $usability->save();

        $notification = [
            'status' => 'success',
            'message' => 'Usability added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('usabilities.index')->with($notification);
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
        $usability = Usability::find($id);
        return view('admin.usabilities.edit', compact('usability'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsabilityUpdateRequest $request)
    {
        $file = $request->file('image');

        $usability = Usability::find($request->id);
        $usability->title = $request->title;
        $usability->link = $request->link;
        $usability->youtube = $request->youtube;
        $usability->description = $request->description;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(302, 618)->save(public_path('upload/usabilities/' . $name));

            $usability->image = $name;
        }

        $usability->save();

        $notification = [
            'status' => 'success',
            'message' => 'Usability added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('usabilities.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usability = Usability::find($id);

        $usability->delete();

        $notification = [
            'message' => 'Usability deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
