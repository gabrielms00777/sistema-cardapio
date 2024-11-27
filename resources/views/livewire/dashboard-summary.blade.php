<div>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-medium text-gray-700">Total de Mesas</h3>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalTables }}</p>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-medium text-gray-700">Pedidos Pendentes</h3>
            <p class="mt-2 text-3xl font-bold text-yellow-500">{{ $pendingOrders }}</p>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-medium text-gray-700">Total Arrecadado (Hoje)</h3>
            <p class="mt-2 text-3xl font-bold text-green-500">R$
                {{ number_format($totalRevenueToday, 2, ',', '.') }}</p>
        </div>
    </div>
</div>
