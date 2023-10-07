@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Manage Candidates') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('candidates.create') }}" class="btn btn-primary mb-3">Create Candidate</a>

                    @if (count($candidates) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($candidates as $candidate)
                                    <tr>
                                        <td>{{ $candidate->name }}</td>
                                        <td>{{ $candidate->description }}</td>
                                        <td>
                                            <a href="{{ route('candidates.edit', ['id' => $candidate->id]) }}" class="btn btn-primary">Edit</a>
                                            <form method="POST" action="{{ route('candidates.destroy', ['id' => $candidate->id]) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No candidates found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection