<x-layouts.site>
    <div x-data="confirmationPage()">
        <header class="flex items-center justify-between p-4 text-white bg-gray-800 shadow-md">
            <a href="{{ route('site.cart') }}"
                class="flex items-center space-x-2 text-lg text-white hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span>Voltar</span>
            </a>
            <h1 class="text-lg font-bold">CArrinho</h1>
            <button class="text-sm text-red-500" @click="clear()">LIMPAR</button>
        </header>

        <div class="p-4 space-y-4 text-center">
            <h2 class="text-xl font-bold">Pedido Confirmado!</h2>
            <p>Obrigado, <span x-text="userName"></span>! Seu pedido está sendo preparado.</p>
            <button @click="goBackToMenu()"
                class="w-full px-4 py-2 text-lg font-bold text-white bg-green-600 rounded-md hover:bg-green-500">
                Voltar ao Menu
            </button>
        </div>


        <div class="fixed bottom-0 flex items-center justify-between w-full p-4 text-white bg-gray-800 shadow-md">

            <button @click="proceedToName()"
                class="flex px-4 py-2 text-lg font-bold text-center bg-gray-700 rounded-md hover:bg-gray-600">
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                </svg>

                CONTUNUAR
            </button>

            <div class="text-lg ">
                R$ <span x-text="totalPrice.toFixed(2)"></span>
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            function confirmationPage() {
                return {
                    userName: localStorage.getItem('userName') || '',
                    goBackToMenu() {
                        window.location.href = '/home'; // Substitua pelo caminho da tela inicial
                    }
                };
            }
        </script>
    </x-slot>
</x-layouts.site>
