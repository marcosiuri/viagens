<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/destino.css') }}">
    <title>Relampago Marquinhos</title>
</head>
<body>
    <header>
        <div class="logo"><h1>Relâmpago Marquinhos</h1></div>
        <nav>
            <ul>
                <li><a href="{{ route('promocao') }}">Promoções</a></li>
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
        <section class="all-destinations">
            @if(isset($destino))
                <h2>{{ $destino->destino }}</h2>
                <p>Valor: R${{ $destino->valor }}</p>
                <p>Quantidade de Vagas: 
                    <button type="button" onclick="ajustarContador({{ $destino->quantidade_pessoas }})">-</button>
                    <span id="quantidade-vagas">{{ $destino->quantidade_pessoas }}</span>
                    <button type="button" onclick="ajustarContador({{ $destino->quantidade_pessoas }})">+</button>
                </p>
                
                <div class="counter">
                    <label for="contador">Contador:</label>
                    <button type="button" onclick="decrement()">-</button>
                    <span id="counterValue">1</span>
                    <button type="button" id="incrementButton" onclick="increment()">+</button>
                    <button type="button" onclick="salvarContador({{ $destino->id }}, {{ $destino->valor }}, {{ $destino->quantidade_pessoas }})">Salvar</button>
                </div>
            @else
                <p>Sem imagem disponível</p>
            @endif
        </section>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        var contadorValue = 1;

        function increment() {
            contadorValue++;
            updateCounter();
        }

        function decrement() {
            if (contadorValue > 1) {
                contadorValue--;
                updateCounter();
            }
        }

        function updateCounter() {
            document.getElementById('counterValue').innerText = contadorValue;
        }

        function salvarContador(destinoId, valor, quantidadePessoas) {
            var contador = contadorValue;

            if (parseInt(contador) > parseInt(quantidadePessoas)) {
                alert('Quantidade excede o limite de vagas disponíveis.');
                return;
            }

            document.getElementById('incrementButton').disabled = true;

            $.ajax({
                type: "POST",
                url: "/destinos/salvar-contador/" + destinoId,
                data: {
                    contador: contador,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    document.getElementById('quantidade-vagas').innerText = response.novaQuantidade;
                    alert('Compra realizada com sucesso!');
                    location.reload();
                },
                error: function(error) {
                    console.error('Erro ao salvar contador:', error);
                }
            });
        }
    </script>
    
</body>
</html>
