@extends('layouts.app') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $vote->title }}</div>

                <div class="card-body">
                    <p>{{ $vote->description }}</p>

                    @if ($vote->isExpired())
                        <p class="text-danger">Голосование закрыто</p>
                        
                    @else
                        <p>Голосование открыто с {{ $vote->start_time }} до {{ $vote->end_time }}</p>
                        @if ($vote->candidates->count() > 0)
                        
                            @if(session('error'))
                            {{session('error')}}
                            @endif
                        <form method="POST" action="{{ route('candidates.vote', ['id' => $vote->id]) }}">
                            @csrf
                            <input type="hidden" name="vote_id" value="{{ $vote->id }}">                         
                            @foreach ($vote->candidates as $candidate)
                                <div class="form-group">
                                    <label for="option{{ $candidate->id }}">{{ $candidate->name }}</label>
                                    <input type="radio" name="selectedCandidate" id="option{{ $candidate->id }}" value="{{ $candidate->id }}" required>
                                </div>
                            @endforeach
            
                            <button type="submit" class="btn btn-primary">Проголосовать</button>
                        </form>
                    @else
                        <p>На данный момент отсутствуют кандидаты</p>
                    @endif
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection