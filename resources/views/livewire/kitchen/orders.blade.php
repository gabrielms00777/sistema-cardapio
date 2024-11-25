<div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
    @forelse ($this->orders as $order)
        <div class="p-6 bg-white shadow-md sm:rounded-lg">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-800">
                    Mesa #{{ $order->table->number }}
                </h3>
                <span
                    class="px-3 py-1 text-sm font-medium rounded-md {{ $order->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : ($order->status === 'in_progress' ? 'bg-blue-200 text-blue-800' : 'bg-green-200 text-green-800') }}">
                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                </span>
            </div>

            <ul class="mt-4 space-y-4">
                @foreach ($order->items as $item)
                    <li x-data="{ status: '{{ $item->status }}' }" class="p-4 border rounded-md shadow-sm bg-gray-50">
                        <div class="flex items-center">
                            <img src="{{ $item->menuItem->image }}" alt="{{ $item->menuItem->name }}"
                                class="w-16 h-16 mr-4 rounded-md">
                            <div>
                                <p class="text-lg font-semibold">{{ $item->menuItem->name }} x
                                    {{ $item->quantity }}</p>
                                <p class="text-gray-600">{{ $item->menuItem->description }}</p>
                                @if ($item->observation)
                                    <p class="">OBS: {{ $item->observation }}</p>
                                @endif

                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <span
                                class="px-3 py-1 text-sm font-medium rounded-md
                                {{ $item->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : ($item->status === 'preparing' ? 'bg-blue-200 text-blue-800' : 'bg-green-200 text-green-800') }}">
                                {{ ucwords(str_replace('_', ' ', $item->status)) }}
                            </span>

                            <div class="flex space-x-2">
                                <button @click="$wire.updateItemStatus('{{ $item->id }}', 'pending')"
                                    class="px-4 py-1 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                    Pendente
                                </button>
                                <button @click="$wire.updateItemStatus('{{ $item->id }}', 'preparing')"
                                    class="px-4 py-1 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                    Em Andamento
                                </button>
                                <button @click="$wire.updateItemStatus('{{ $item->id }}', 'ready')"
                                    class="px-4 py-1 text-white bg-green-500 rounded-md hover:bg-green-600">
                                    Concluído
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @empty
        <div class="p-6 text-gray-900 bg-white shadow-sm sm:rounded-lg">
            <p class="text-center">Nenhum pedido no momento.</p>
        </div>
    @endforelse
</div>
