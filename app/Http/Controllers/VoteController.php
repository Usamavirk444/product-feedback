<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $query = Vote::where(['feedback_id' => $id, 'user_id' => $user->id]);
        $voteExists = $query->first();
        $sameVoteExists =  $query->where('vote', $request->vote)->exists();
        if($sameVoteExists){
            return redirect()->back()->with('errors', 'You have already voted with the same value for this feedback.');
        }
        if ($voteExists) {
            $voteExists->update(['vote' => $request->vote]);
        } else {
            $vote = new Vote([
                'feedback_id' => $id,
                'user_id' => $user->id,
                'vote' => $request->vote,
            ]);
            $vote->save();
        }

        return redirect()->back()->with('success', 'Vote recorded successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
