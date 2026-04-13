<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AnswerStoreRequest;
use App\Http\Requests\Backend\AnswerUpdateStore;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Answer::latest()->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerStoreRequest $request)
    {
        Answer::create($request->validated());

        $notification = [
            'status' => 'success',
            'message' => 'Answer added successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('faqs.index')->with($notification);
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
        $faq = Answer::find($id);

        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnswerUpdateStore $request)
    {
        $answer = Answer::find($request->id);

        $answer->title = $request->title;
        $answer->description = $request->description;
        $answer->save();

        $notification = [
            'status' => 'success',
            'message' => 'Answer updated successfully.',
            'alert-type' => 'success',
        ];

        return redirect()->route('faqs.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $answer = Answer::find($id);

        $answer->delete();

        $notification = [
            'message' => 'Answer deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
