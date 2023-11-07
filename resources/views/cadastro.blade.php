<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/cadastro.css') }}">
    <title>Relampago Marquinhos</title>
</head>
<body>
    <header>
        <div class="logo"><h1>Relâmpago Marquinhos</h1></div>
        <nav>
            <ul>
                <li><a href="{{ route('promocao') }}">Promoções</a></li>
                <li><a href="{{ route('main') }}"><button>Todos os Destinos</button></a></li>
                <li><a href="{{ route('sobre') }}">Sobre Nos</a></li>
            </ul>
        </nav>
        @if(auth()->check())

            
        

            <div>
                <button style="background-color: rgb(0, 187, 255);color:white; border: none;text-decoration: none;"><a href="{{ route('minha') }}">Minha Conta</a></button>
                <button style="background-color: rgb(0, 187, 255);color:white; border: none;text-decoration: none;"><a href="{{ route('logout') }}">Sair</a></button>
            </div>
        @else  
            
            <div>
            <button style="background-color: rgb(0, 187, 255);color:white; border: none;text-decoration: none;"><a href="{{ route('login') }}">Entrar</a></button>
            <button style="background-color: rgb(0, 187, 255);color:white; border: none;text-decoration: none;"><a href="{{ route('cadastro') }}">Cadastrar</a></button>
            </div>
        @endif
    </header>
    
    <div class="cadastroBox">
        <h3>Cadastro</h3>
        <form method="post" action="{{ route('cadastro') }}">
            @csrf
            <div class="inputBox">
                <input type="text" name="name" placeholder="Seu Nome"> 
                <input type="text" name="username" placeholder="Usuário"> 
                <input type="password" name="password" placeholder="Senha"> 
                <input type="password" name="password_confirmation" placeholder="Confirma Senha"> 
                
                @if(!$errors->isEmpty())
                    <h4>{{ $errors->first() }}</h4>
                @endif
            </div>
            <input type="submit" value="Cadastrar">
            <button type="button" class="btnBack" onclick="window.history.back()">Voltar</button>
        </form>
    </div>

</body>
</html>
