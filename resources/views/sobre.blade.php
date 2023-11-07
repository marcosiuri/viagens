<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/sobre.css') }}">
    <title>Relâmpago Marquinhos</title>
</head>
<body>
    <header>
        <div class="logo"><h1>Relâmpago Marquinhos</h1></div>
        <nav>
            <ul>
                <li><a href="{{ route('promocao') }}">Promoções</a></li>
                <li><a href="{{ route('main') }}"><button>Todos os Destinos</button></a></li>
                <li><a href="{{ route('destino.create') }}"><button>Cadastrar Novo Destino</button></a></li>
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

    <div class="container">
        <section id="sobre">
            <h2>Sobre Nós</h2>
            <p>Bem-vindo à Relâmpago Marquinhos, sua companhia de viagens de confiança. Fundada por Marcos Iuri em 22 de julho de 2023, somos apaixonados por proporcionar experiências incríveis a cada viagem.</p>
            
            <p>Nossa jornada começou com a visão de tornar as viagens mais acessíveis e memoráveis para todos. Desde então, temos trabalhado incansavelmente para oferecer destinos únicos, pacotes exclusivos e um serviço de alta qualidade.</p>
            
            <p>Nosso compromisso é criar momentos inesquecíveis para nossos clientes. Seja explorando destinos exóticos, relaxando em praias paradisíacas ou vivendo aventuras emocionantes, estamos aqui para transformar seus sonhos de viagem em realidade.</p>
        </section>
    </div>
</body>
</html>
