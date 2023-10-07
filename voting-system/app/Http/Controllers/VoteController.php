<?php


namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class VoteController extends Controller
{
    public function create()
    {
        return view('votes.create'); 
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
           
        ]);

        
        $vote = new Vote();
        $vote->title = $request->input('title');
        $vote->description = $request->input('description');
        $vote->start_time = $request->input('start_time');
        $vote->end_time = $request->input('end_time');
     
        $vote->save();
       
        return redirect()->route('view.vote', ['id' => $vote->id]);
    }

    public function view($id)
    {
       

       $vote = Vote::findOrFail($id);
        return view('votes.view', compact('vote'));
        
    }

   
}