<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;


class CandidateController extends Controller
{
    public function manage()
    {
        $candidates = Candidate::all();
        return view('candidates.manage', compact('candidates'));
    }


public function create()
{
    return view('candidates.candidates_create');
}


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'vote_id' => 'required|integer',
    ]);

    Candidate::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'vote_id' => $request->input('vote_id'),

    ]);

    return redirect()->route('candidates.manage')->with('success', 'Кандидат успешно добавлен.');
}


public function edit($id)
{
    $candidate = Candidate::findOrFail($id);
    return view('candidates.candidates_edit', compact('candidate'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'vote_id' => 'required|integer',
        
    ]);

    $candidate = Candidate::findOrFail($id);
    $candidate->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'vote_id' => $request->input('vote_id'),
       
    ]);

    return redirect()->route('manage.candidates')->with('success', 'Данные кандидата обновлены.');
}

public function destroy($id)
{
    $candidate = Candidate::findOrFail($id);
    $candidate->delete();
    return redirect()->route('candidates.manage')->with('success', 'Кандидат успешно удален.');
}

public function vote(Request $request)
{

    $selectedCandidateId = $request->input('selectedCandidate');
    $candidate = Candidate::findOrFail($selectedCandidateId);
    
    
 $user = auth()->user();
 
 if ($user->votes->contains('id', $request->vote_id)) {
    
     return redirect()->back()->with('error', 'Вы уже проголосовали в этом голосовании.');
 }

    $candidate->increment('count');
  
    $candidate->save();

      $user->markAsVotedIn($candidate->vote_id);
    
    $vote = Vote::findOrFail($candidate->vote_id);
    $candidates = Candidate::where('vote_id', $candidate->vote_id)->get();

    return redirect()->route('view.vote', ['id' => $candidate->vote_id])->with('success', 'Вы успешно проголосовали за ' . $candidate->name);
}

public function view($id)
{
    $vote = Vote::findOrFail($id);
    $candidates = Candidate::where('vote_id', $id)->get();

    return view('votes.view', compact('vote', 'candidates'));
}


}