<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-2xl font-bold text-gray-800">Relatórios</h2>

    <!-- Filtros -->
    <div class="flex mb-6 space-x-4">
        <div>
            <label class="block text-gray-700">Data Inicial:</label>
            <input type="date" wire:model="startDate" class="w-full p-2 mt-1 border rounded">
        </div>
        <div>
            <label class="block text-gray-700">Data Final:</label>
            <input type="date" wire:model="endDate" class="w-full p-2 mt-1 border rounded">
        </div>
        <div>
            <label class="block text-gray-700">Tipo de Relatório:</label>
            <select wire:model.live="selectedReport" class="w-full p-2 mt-1 border rounded">
                <option value="daily">Diário</option>
                <option value="tables">Mesas</option>
            </select>
        </div>
    </div>

    <!-- Tabela de Relatórios -->
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th
                    class="px-5 py-3 text-sm font-semibold text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200">
                    @if ($selectedReport == 'daily')
                        Data
                    @else
                        Mesa
                    @endif
                </th>
                <th
                    class="px-5 py-3 text-sm font-semibold text-left text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200">
                    Total
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr class="hover:bg-gray-100">
                    <td class="px-5 py-5 text-sm border-b border-gray-200">
                        @if ($selectedReport == 'daily')
                            {{ $item->date }}
                        @else
                            Mesa #{{ $item->id }}
                        @endif
                    </td>
                    <td class="px-5 py-5 text-sm border-b border-gray-200">
                        R$ {{ number_format($item->total_sales ?? $item->orders_count * 10, 2, ',', '.') }}
                        <!-- Exemplo simplificado -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
