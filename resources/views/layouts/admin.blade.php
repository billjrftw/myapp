<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>MyApp Cadastro</title>
</head>
<body>
    <div class="main-container">
        <header class="header">
            <div class="content-header">
                <h2 class="title-logo">
                    <a href="{{ route('dashboard') }}">MyApp</a>
                </h2>
                <ul class="list-nav-link">
                    <li><a href="{{ route('user.index') }}" class="nav-link">Usuários</a></li>
                    <li><a href="{{ route('dashboard') }}" class="nav-link">Sair</a></li>
                </ul>
            </div>
        </header>
        
        @yield('content')
    </div>

</body>
</html>