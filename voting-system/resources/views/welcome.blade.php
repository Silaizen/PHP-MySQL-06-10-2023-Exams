
<!DOCTYPE html>
<html>
<head>
    <title>Voting System</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('main') }}">Главная</a></li>
               
            </ul>
        </nav>
    </header>
    <main>
        <h1>Добро пожаловать в систему голосования</h1>
     
        @if (Auth::user()->is_admin == 1)     

        <p>Вы вошли как {{ Auth::user()->name }}</p>
      
          <li><a href="{{ route('create.vote.form') }}">Создать голосование</a></li>
          <li><a href="{{ route('manage.candidates') }}">Управление кандидатами</a></li>
         
          @endif

    <h2>Популярные голосования</h2>
    <ul>
      
        @foreach($votes as $vote)
        <li>
            <a href="{{ route('view.vote', ['id' => $vote->id]) }}">
                {{ $vote->title }}
            </a>
        </li>
    @endforeach
        
    </ul>
</main>
</body>
</html>