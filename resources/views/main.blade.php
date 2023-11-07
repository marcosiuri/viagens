<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
    <title>Relâmpago Marquinhos</title>
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

    <div class="destino_main">
        <div class="destino">
            <label for="destination">onde vai:</label>
            <div style="position: relative;">
                <input type="text" id="destination" placeholder="Digite o destino" oninput="showSuggestions()">
                <ul id="suggestionList"></ul>
            </div>

            <label for="departure">ida:</label>
            <input type="date" id="departure">

            <label for="return">volta:</label>
            <input type="date" id="return">

            <label for="counter">Número de viajantes:</label>
            <div class="counter">
                <button onclick="decrement()">-</button>
                <span id="counterValue">1</span>
                <button onclick="increment()">+</button>
            </div>
            <button>Salvar</button>
        </div>
    </div>

    <div class="main-content">
        <h2>Todos os Destinos</h2>
        <section class="all-destinations">
            @foreach($destinos as $destino)
                <div class="destination-item">
                    @if($destino->imagem)
                        <img src="{{ $destino->imagem }}" alt="{{ $destino->destino }}">
                    @else
                        <p>Sem imagem disponível</p>
                    @endif
                    <h3>{{ $destino->destino }}</h3>
                    <button><a href="{{ route('destino.show', ['id' => $destino->id]) }}">Ver Mais</a></button>
                </div>
            @endforeach
        </section>        
    </div>
    
    <script>
        let counterValue = 1;

        function increment() {
            counterValue++;
            updateCounter();
        }

        function decrement() {
            if (counterValue > 1) {
                counterValue--;
                updateCounter();
            }
        }

        function updateCounter() {
            document.getElementById('counterValue').innerText = counterValue;
        }

        function showSuggestions() {
            var inputVal = document.getElementById('destination').value;

            if (inputVal.trim() !== '') {
                fetch('/buscar-sugestoes?query=' + inputVal)
                    .then(response => response.json())
                    .then(data => {
                        displaySuggestions(data);
                    })
                    .catch(error => {
                        console.error('Erro ao buscar sugestões:', error);
                    });
            } else {
                mostrarSugestoesPadrao();
            }
        }

        function mostrarSugestoesPadrao() {
            var sugestoesPadrao = ['Belo Horizonte', 'Aparecida', 'Maldivas'];
            displaySuggestions(sugestoesPadrao);
        }

        function displaySuggestions(suggestions) {
            var suggestionList = document.getElementById('suggestionList');
            suggestionList.innerHTML = '';

            suggestions.forEach(suggestion => {
                var listItem = document.createElement('li');
                listItem.textContent = suggestion;

                listItem.addEventListener('click', function() {
                    document.getElementById('destination').value = suggestion;
                    clearSuggestions();
                });

                suggestionList.appendChild(listItem);
            });

            suggestionList.style.display = 'block';
        }

        function clearSuggestions() {
            var suggestionList = document.getElementById('suggestionList');
            suggestionList.innerHTML = '';
            suggestionList.style.display = 'none';
        }

        document.addEventListener('click', function(event) {
            var suggestionList = document.getElementById('suggestionList');
            if (event.target !== suggestionList && !suggestionList.contains(event.target)) {
                clearSuggestions();
            }
        });

    </script>

</body>
</html>
