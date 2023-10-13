<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Parsedown;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $feedbacksQuery = Feedback::with('user');

        if ($request->has('category') && $request->category != '') {
            $feedbacksQuery->where('category', $request->category);
        }

        if ($request->has('sort')) {
            if ($request->sort === 'latest') {
                $feedbacksQuery->latest();
            } elseif ($request->sort === 'votes') {
                $feedbacksQuery->withCount('votes')->orderByDesc('votes_count');
            }
        } else {
            $feedbacksQuery->latest();
        }

        $feedbacks = $feedbacksQuery->paginate(1);

        $userVotes = auth()->user()->votes->pluck('vote', 'feedback_id')->toArray();

        return view('feedback.index', compact('feedbacks', 'userVotes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:bug,feature,improvement',
            'attachments.*' => 'file|mimes:jpeg,png,pdf|max:2048',
        ];

        $messages = [
            'attachments.*.max' => 'The attachment must not exceed 2MB in size.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('feedback.create')
                ->withErrors($validator)
                ->withInput();
        }

        $feedback = new Feedback();
        $feedback->title = $request->input('title');
        $feedback->description = $request->input('description');
        $feedback->category = $request->input('category');
        $feedback->user_id = auth()->user()->id;
        $feedback->save();

        // Handle attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $attachment) {
                $path = $attachment->store('attachments', 'public');

                $feedback->attachments()->create([
                    'filename' => $path,
                ]);
            }
        }

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $feedback = Feedback::with('user', 'attachments')->findOrFail($id);
        $comments = Comment::where('feedback_id', $id)->orderBy('created_at', 'desc')->get();

        return view('feedback.show', compact('feedback', 'comments','id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
