<x-layouts.site>
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
            @if (session()->has('table_id'))
            <a href="{{ route('site.home') }}" class="border btn btn-primary">Ir para o cardapio</a>
            
            @else
            <p>leia o qrcode </p>
                
            @endif
        </main>

        <div class="flex items-center justify-center py-3 bg-zinc-300">
            <p>
                Desenvolvido por: <a class="text-blue-600" href="https://gcmsistemas.com.br">GCM Sistemas</a>
            </p>
        </div>
    </div>
</x-layouts.site>
