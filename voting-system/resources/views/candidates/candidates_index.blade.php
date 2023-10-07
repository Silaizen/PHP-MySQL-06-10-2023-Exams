@extends('layouts.app') 

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Список кандидатов</div>

                    <div class="card-body">
                        @if (count($candidates) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Имя</th>
                                        <th>Описание</th>
                                        <th>Действия</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidates as $candidate)
                                        <tr>
                                            <td>{{ $candidate->name }}</td>
                                            <td>{{ $candidate->description }}</td>
                                            <td>
                                                <a href="{{ route('candidates.edit', ['id' => $candidate->id]) }}" class="btn btn-primary">Редактировать</a>
                                                <form method="POST" action="{{ route('candidates.destroy', ['id' => $candidate->id]) }}" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Список кандидатов пуст.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection