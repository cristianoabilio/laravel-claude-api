<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TeamStoreRequest;
use App\Http\Requests\Backend\TeamUpdateRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::latest()->get();

        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamStoreRequest $request)
    {
        $file = $request->file('image');

        $team = new Team();
        $team->name = $request->name;
        $team->position = $request->position;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(60, 60)->save(public_path('upload/team/' . $name));

            $team->image = $name;
        }

        $team->save();

        $notification = [
            'status' => 'success',
            'message' => 'Team Member added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('team.index')->with($notification);
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
        $team = Team::find($id);

        return view('admin.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamUpdateRequest $request)
    {
        $file = $request->file('image');

        $teamId = $request->id;

        $team = Team::find($teamId);
        $team->name = $request->name;
        $team->position = $request->position;

        if ($file) {
            $manager = ImageManager::usingDriver(Driver::class);

            $img = $manager->decode($file);
            $name = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $img->resize(60, 60)->save(public_path('upload/team/' . $name));

            $team->image = $name;
        }

        $team->save();

        $notification = [
            'status' => 'success',
            'message' => 'Team member updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('team.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::find($id);
        $path = 'upload/team/';
        $image = $team->image;
        unlink($path.$image);

        $team->delete();

        $notification = [
            'message' => 'Team member deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
