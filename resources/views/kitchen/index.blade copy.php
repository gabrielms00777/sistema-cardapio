<x-layouts.kitchen>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cozinha - Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div x-data="ordersHandler()" x-init="initOrders()">
                <template x-if="orders.length == 0">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-900">
                        <p class="text-center">Nenhum pedido no momento.</p>
                    </div>
                </template>
            </div>
            <p x-text="orders"></p>
            <template x-for="order in orders" :key="order.id">
                <div class="bg-white shadow-md sm:rounded-lg p-6" :hidden='hidden' x-data="orderHandler(order.id, order.items)">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">
                            Pedido # <span x-text="order.id"></span>
                        </h3>
                        <span x-text="order.status.charAt(0).toUpperCase() + order.status.slice(1).replace('_', ' ')"
                            class="px-3 py-1 text-sm font-medium rounded-md"
                            :class="{
                                'bg-yellow-200 text-yellow-800': order.status === 'pending',
                                'bg-blue-200 text-blue-800': order.status === 'preparing',
                                'bg-green-200 text-green-800': order.status === 'ready'
                            }"></span>
                    </div>

                    <ul class="mt-4 space-y-4">
                        <template x-for="item in order.items" :key="item.id">
                            <li x-data="{ status: item.status }" class="p-4 border rounded-md bg-gray-50 shadow-sm">
                                <div class="flex items-center">
                                    <img :src="item.menuItem.image" :alt="tem.menuItem.name"
                                        class="w-16 h-16 rounded-md mr-4">
                                    <div>
                                        <p class="text-lg font-semibold"
                                            x-text="`${item.menuItem.name} x ${item.quantity}`"> </p>
                                        <template x-if="item.observation">
                                            <p class="text-gray-600" x-text="item.menuItem.description"></p>
                                        </template>

                                    </div>
                                </div>

                                <div class="mt-4 flex justify-between items-center">
                                    <span
                                        x-text="item.status.charAt(0).toUpperCase() + item.status.slice(1).replace('_', ' ')"
                                        class="px-3 py-1 text-sm font-medium rounded-md"
                                        :class="{
                                            'bg-yellow-200 text-yellow-800': item.status === 'pending',
                                            'bg-blue-200 text-blue-800': item.status === 'preparing',
                                            'bg-green-200 text-green-800': item.status === 'ready'
                                        }"></span>

                                    <div class="flex space-x-2">
                                        <button @click="updateItemStatus(item.id, 'pending')"
                                            class="px-4 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                            Pendente
                                        </button>
                                        <button @click="updateItemStatus(item.id, 'preparing')"
                                            class="px-4 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                            Em Andamento
                                        </button>
                                        <button @click="updateItemStatus(item.id, 'ready')"
                                            class="px-4 py-1 bg-green-500 text-white rounded-md hover:bg-green-600">
                                            Concluído
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>
            </template>
        </div>
    </div>

    <script>
        function ordersHandler() {
            return {
                orders: [],
                initOrders() {
                    this.fetchOrders()
                    this.listenForOrderUpdates()
                    console.log(this.orders)
                },
                fetchOrders() {
                    fetch('/orders', {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            this.orders = data
                            console.log(this.orders)
                        })
                        .catch(error => console.error('Erro ao buscar pedidos:', error))
                },
                listenForOrderUpdates() {
                    Echo.channel('orders')
                        .listen('OrderCreated', (e) => {
                            console.log('Novo pedido criado:', e.order);
                            this.fetchOrders()
                        });
                }

            }
        }

        function orderHandler(orderId, items) {
            return {
                orderId,
                items,
                hidden: false,

                init() {
                    if (this.allItemsReady()) {
                        this.updateOrderStatus('ready');
                    }
                },
                updateItemStatus(itemId, newStatus) {
                    fetch(`/order-items/${itemId}/update-status`, {
                            method: 'PUT',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                            },
                            body: JSON.stringify({
                                status: newStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.status = newStatus;
                                this.items.find(item => (item.id == itemId)).status = newStatus;
                                this.items;
                                this.allItemsReady();
                                if (this.allItemsReady()) {
                                    this.updateOrderStatus('ready');
                                }
                                alert('Status atualizado com sucesso!');
                            } else {
                                alert('Erro ao atualizar status.');
                            }
                        })
                },
                allItemsReady() {
                    return this.items.every(item => item.status === 'ready');
                },
                updateOrderStatus(newStatus) {
                    this.hidden = true
                    fetch(`/order/${this.orderId}/status`, {
                        method: 'PUT',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                        },
                        body: JSON.stringify({
                            status: newStatus
                        })
                    })
                }
            }
        }
    </script>
</x-layouts.kitchen>
