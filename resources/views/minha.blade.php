<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/sobre.css') }}">
    <title>Relampago Marquinhos</title>
</head>
<body>
    <header>
        <div class="logo"><h1>Relâmpago Marquinhos</h1></div>
        <nav>
            <ul>
                <li><a href="{{ route('promocao') }}">Promoções</a></li>
                <li><a href="{{ route('main') }}"><button>Todos os Destinos</button></a></li>
                <li><a href="{{ route('destino.create') }}"><button>Cadastrar Novo Destino</button></a></li>
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

    <div class="main-content">
        <h1>Bem-vindo, {{ Auth::user()->name }}!</h1>
        <h2>Estes são os seus Destinos</h2>
        <div>
            <h3>Suas Passagens:</h3>
            @foreach(auth()->user()->passagens as $passagem)
                <div class="passagem-item">
                    <p>{{ $passagem->destino->destino }} - {{ $passagem->quantidade }} passagens</p>
                    <p id="valorTotal-{{ $passagem->id }}">Valor Total: R$ <span id="valorPassagem-{{ $passagem->id }}">{{ $passagem->valor_total }}</span></p>
                    <div class="contador">
                        <label for="contador">Contador:</label>
                        <button type="button" onclick="decrement({{ $passagem->id }}, {{ $passagem->destino->id }})">-</button>
                        <span id="contador-{{ $passagem->id }}">{{ $passagem->quantidade }}</span>
                        <button type="button" onclick="increment({{ $passagem->id }}, {{ $passagem->destino->id }})">+</button>
                    </div>
                    <button onclick="cancelarPassagem({{ $passagem->id }}, {{ $passagem->destino->id }})">Cancelar Passagem</button>
                    <button onclick="diminuirPassagem({{ $passagem->id }}, {{ $passagem->destino->id }})">Diminuir Passagem</button>
                </div>
            @endforeach
        </div>        
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function increment(passagemId, destinoId) {
            var contadorElement = $('#contador-' + passagemId);
            var contadorValue = parseInt(contadorElement.text());
            contadorValue++;
            contadorElement.text(contadorValue);
    
            updateValorTotal(passagemId, destinoId, contadorValue);
        }
    
        function decrement(passagemId, destinoId) {
            var contadorElement = $('#contador-' + passagemId);
            var contadorValue = parseInt(contadorElement.text());
            if (contadorValue > 1) {
                contadorValue--;
                contadorElement.text(contadorValue);
    
                updateValorTotal(passagemId, destinoId, contadorValue);
            }
        }
    
        function updateValorTotal(passagemId, destinoId, contadorValue) {
            var valorPassagem = parseFloat($('#valorPassagem-' + passagemId).text());
            var valorTotal = valorPassagem * contadorValue;
            $('#valorTotal-' + passagemId).text('Valor Total: R$ ' + valorTotal.toFixed(2));
        }
    
        function cancelarPassagem(passagemId, destinoId) {
            if (confirm('Tem certeza que deseja cancelar essa passagem?')) {
                $.ajax({
                    type: "POST",
                    url: "/minha/cancelar-passagem/" + passagemId + "/" + destinoId,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            console.error('Erro ao cancelar passagem.');
                        }
                    },
                    error: function(error) {
                        console.error('Erro ao cancelar passagem:', error);
                    }
                });
            }
        }
    
        function diminuirPassagem(passagemId, destinoId) {
            if (confirm('Tem certeza que deseja diminuir o número de passagens?')) {
                $.ajax({
                    type: "POST",
                    url: "/minha/diminuir-passagem/" + passagemId + "/" + destinoId,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            console.error('Erro ao diminuir passagem.');
                        }
                    },
                    error: function(error) {
                        console.error('Erro ao diminuir passagem:', error);
                    }
                });
            }
        }
    </script>
</body>
</html>
