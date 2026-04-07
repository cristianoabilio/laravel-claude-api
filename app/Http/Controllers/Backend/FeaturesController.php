<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\FeatureStoreRequest;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::latest()->get();
        return view('admin.features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureStoreRequest $request)
    {
        Feature::create($request->validated());

        $notification = [
            'status' => 'success',
            'message' => 'Feature added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('features.all')->with($notification);
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
        $feature = Feature::find($id);

        return view('admin.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FeatureStoreRequest $request)
    {
        $feature = Feature::find($request->id);

        $feature->title = $request->title;
        $feature->icon = $request->icon;
        $feature->description = $request->description;
        $feature->save();

        $notification = [
            'status' => 'success',
            'message' => 'Feature updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('features.all')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feature = Feature::find($id);

        $feature->delete();

        $notification = [
            'message' => 'Feature deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
