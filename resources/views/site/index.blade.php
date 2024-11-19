<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex flex-col min-h-screen">
        <header class="text-white bg-blue-700">
            <div class="container flex items-center justify-center py-2 mx-auto">
                <h3 class="text-sm font-light">
                    Estamos disponiveis para receber pedidos!
                </h3>
            </div>
        </header>

        <main
            class="bg-cover flex-1 bg-center bg-[url('https://via.placeholder.com/1920x1080')] flex flex-col justify-center items-center">
            <h1 class="mb-6 text-4xl font-bold text-center">Lanchão do Zé</h1>
            <a href="{{ route('site.home') }}" class="border btn btn-primary">Ir para o cardapio</a>
        </main>

        <div class="flex items-center justify-center py-3 bg-zinc-300">
            <p>
                Desenvolvido por: <a class="text-blue-600" href="https://gcmsistemas.com.br">GCM Sistemas</a>
            </p>
        </div>
    </div>
</body>

</html>
