<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ConnectStoreRequest;
use App\Http\Requests\Backend\ConnectUpdateRequest;
use App\Models\Connect;
use Illuminate\Http\Request;

class ConnectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $connects = Connect::latest()->get();
        return view('admin.connects.index', compact('connects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.connects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConnectStoreRequest $request)
    {
        Connect::create($request->validated());

        $notification = [
            'status' => 'success',
            'message' => 'Connect added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('connects.index')->with($notification);
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
        $connect = Connect::find($id);

        return view('admin.connects.edit', compact('connect'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConnectUpdateRequest $request)
    {
        $connect = Connect::find($request->id);

        $connect->title = $request->title;
        $connect->description = $request->description;
        $connect->save();

        $notification = [
            'status' => 'success',
            'message' => 'Connect updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('connects.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $connect = Connect::find($id);

        $connect->delete();

        $notification = [
            'message' => 'Connect deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
