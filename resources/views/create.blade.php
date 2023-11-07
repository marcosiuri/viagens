<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/create.css') }}">
    <title>Cadastro de Destino</title>
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

    <div class="cadastro-destino">
        <h2>Cadastrar Novo Destino</h2>
        <form action="{{ route('destino.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required>

            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" min="0" step="0.01" required>

            <label for="quantidade_pessoas">Quantidade de Pessoas:</label>
            <input type="number" id="quantidade_pessoas" name="quantidade_pessoas" min="1" required>

            <div>
                <label for="imagem">Imagem:</label>
                <input type="file" name="imagem" accept="image/*">
            </div>

            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <script>
        // Se precisar de scripts específicos para essa página, pode adicionar aqui.
    </script>

</body>
</html>
