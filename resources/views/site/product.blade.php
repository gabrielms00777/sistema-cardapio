<x-layouts.site>
    <div class="flex flex-col min-h-screen bg-gray-100" x-data="{
        quantity: 1,
        product: {{ json_encode($product) }},
        observation: '',
        addToCart() {
            if (this.quantity < 1) {
                this.quantity = 1
            }

            let cart = localStorage.getItem('cart');
            cart = cart ? JSON.parse(cart) : [];

            const existingItemIndex = cart.findIndex(item => item.id === this.product.id)
            if (existingItemIndex !== -1) {
                cart[existingItemIndex].quantity += this.quantity
                cart[existingItemIndex].observation = this.observation
            } else {
                cart.push({
                    ...this.product,
                    quantity: this.quantity,
                    observation: this.observation
                })
            }

            localStorage.setItem('cart', JSON.stringify(cart))

            this.quantity = 1
            this.observation = ''

            alert('Produto adicionado ao carrinho com sucesso!')
            window.location.href = '/home'
        }
    }">

        <header class="flex items-center justify-between p-4 text-white bg-gray-800 shadow-md">
            <a href="{{ route('site.home') }}" class="flex items-center space-x-2 text-lg text-white hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Voltar</span>
            </a>
            <h1 class="text-lg font-bold">{{ $product['name'] }}</h1>
        </header>

        <main class="flex-1 p-4">
            <!-- Imagem do Item -->
            <img src{{ $product['image'] }} alt={{ $product['name'] }}
                class="object-cover w-full h-64 mb-4 rounded-lg shadow-md" />

            <!-- Detalhes do Item -->
            <div class="p-4 space-y-2 bg-white rounded-lg shadow-md">
                <h2 class="text-xl font-bold">{{ $product['name'] }}</h2>
                <p class="text-gray-600">{{ $product['description'] }}</p>
                <p class="text-2xl font-bold text-green-600">
                    R${{ $product['price'] }}
                </p>
            </div>

            <!-- Observação -->
            <div class="mt-4">
                <label for="observation" class="block mb-1 font-medium text-gray-800">
                    Observações
                </label>
                <textarea id="observation" x-model="observation" placeholder="Exemplo: Retirar cebola, etc..."
                    class="w-full p-2 border border-gray-300 rounded-lg" rows="3"></textarea>
            </div>
        </main>

        <footer class="flex items-center justify-between p-4 text-white bg-gray-800 shadow-inner">
            <div class="flex items-center space-x-4">
                <button @click="quantity = Math.max(quantity - 1, 1)"
                    class="p-2 text-white bg-gray-700 rounded-md hover:bg-gray-600">
                    -
                </button>
                <span class="text-lg font-bold" x-text="quantity"></span>
                <button @click="quantity += 1" class="p-2 text-white bg-gray-700 rounded-md hover:bg-gray-600">
                    +
                </button>
            </div>

            <button @click="addToCart"
                class="px-6 py-2 text-lg font-bold text-white bg-green-600 rounded-md hover:bg-green-500">
                Adicionar ao Carrinho (R$ <span x-text="(product.price * quantity).toFixed(2)"></span>)
            </button>
        </footer>
    </div>
</x-layouts.site>
