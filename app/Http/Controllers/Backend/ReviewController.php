<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ReviewStoreRequest;
use App\Http\Requests\Backend\ReviewUpdateRequest;
use App\Models\Review;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::latest()->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewStoreRequest $request)
    {
        $file = $request->file('image');

        $review = new Review();
        $review->name = $request->name;
        $review->position = $request->position;
        $review->message = $request->message;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(60, 60)->save(public_path('upload/reviews/' . $name));

            $review->image = $name;
        }

        $review->save();

        $notification = [
            'status' => 'success',
            'message' => 'Review added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('reviews.all')->with($notification);

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
        $review = Review::find($id);

        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewUpdateRequest $request)
    {
        $file = $request->file('image');

        $reviewId = $request->id;

        $review = Review::find($reviewId);
        $review->name = $request->name;
        $review->position = $request->position;
        $review->message = $request->message;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(60, 60)->save(public_path('upload/reviews/' . $name));

            $review->image = $name;
        }

        $review->save();

        $notification = [
            'status' => 'success',
            'message' => 'Review updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('reviews.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::find($id);
        $path = 'upload/reviews/';
        $image = $review->image;
        unlink($path.$image);

        $review->delete();

        $notification = [
            'message' => 'Review deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
