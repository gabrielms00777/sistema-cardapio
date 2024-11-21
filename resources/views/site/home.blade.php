<x-layouts.site>
    <div>
        <header class="sticky top-0 z-10 px-4 pt-4 bg-gray-800 shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button id="openDrawer" class="btn" aria-haspopup="dialog" aria-expanded="false"
                        aria-controls="overlay-example" data-overlay="#overlay-example">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <p class="text-lg font-medium text-white">
                        Mesa <span id="mesaNumber">1</span>
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <p class="text-lg font-medium text-white">Meu Consumo</p>
                    <a href="https://wa.me/SEUNUMERODOWHATSSAPP?text=Olá,%20gostaria%20de%20fazer%20um%20pedido."
                        target="_blank" class="text-white hover:text-gray-300">
                        <span class="icon-[logos--whatsapp-icon]"></span>
                    </a>
                </div>
            </div>

            <input type="search" placeholder="Buscar itens..."
                class="w-full p-2 mt-4 text-gray-700 bg-white border border-gray-600 rounded" />

            <div class="py-4 overflow-x-auto whitespace-nowrap">
                <ul class="flex space-x-3">
                    @foreach ($categories as $category)
                        <li>
                            <a href="#category-{{ $category->id }}"
                                class="px-4 py-2 font-medium text-white rounded hover:text-gray-700 hover:bg-gray-300">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </header>
        @foreach ($categories as $category)
            <div id="category-{{ $category->id }}">
                <h2 class="px-4 py-2 mb-4 text-base font-bold text-white bg-gray-700">
                    {{ $category->name }}
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($category->menuItems as $item)
                        <a 
                            href="{{ route('site.product', $item->id) }}"
                            class="flex items-center p-4 bg-white rounded-lg shadow-md cursor-pointer">
                            <img src={{ $item->image }} alt={{ $item->name }}
                                class="object-cover w-24 h-24 mr-4 rounded-md" />

                            <div class="flex flex-col items-start justify-between">
                                <h3 class="text-lg font-medium">{{ $item->name }}</h3>
                                <p class="text-gray-600">{{ Str::limit($item->description, 40, '...') }}</p>
                                <span class="p-1 mt-4 font-bold text-white bg-gray-700 rounded-md text-md">
                                    R$ {{ $item->price * 100 }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div x-data="cartSummary()" x-show="cartItems.length > 0"
            class="fixed bottom-0 flex items-center justify-between w-full p-4 text-white bg-gray-800 shadow-md">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
                </svg>

                <span x-text="totalQuantity"></span>
            </div>

            <button @click="redirectToCart()"
                class="px-4 py-2 text-lg font-bold text-center bg-gray-700 rounded-md hover:bg-gray-600">
                VER CARRINHO
            </button>

            <div class="text-lg font-light">
                R$ <span x-text="totalPrice.toFixed(2)"></span>
            </div>
        </div>

    </div>


    <script>
        function cartSummary() {
            return {
                cartItems: JSON.parse(localStorage.getItem('cart')) || [],
                get totalQuantity() {
                    return this.cartItems.reduce((sum, item) => sum + item.quantity, 0);
                },
                get totalPrice() {
                    return this.cartItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
                },
                redirectToCart() {
                    window.location.href = '/home/cart';
                },
                init() {
                    this.cartItems = JSON.parse(localStorage.getItem('cart')) || [];
                }
            };
        }

        document.querySelectorAll("a[href^='#']").forEach((anchor) => {
            anchor.addEventListener("click", function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute("href"));
                const offset = document.querySelector("header").offsetHeight;
                console.log(target)
                console.log(offset)

                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - offset,
                        behavior: "smooth",
                    });
                }
            });
        });
    </script>

</x-layouts.site>
