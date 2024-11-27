<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard do Gerente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <livewire:dashboard-summary lazy />

            <livewire:report-dashboard lazy />


            <!-- Tabelas de Detalhes -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-lg font-medium text-gray-700">Resumo das Mesas</h3>
                <table class="w-full text-sm text-left border border-collapse border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-2 border border-gray-300">Mesa</th>
                            <th class="px-4 py-2 border border-gray-300">Status</th>
                            <th class="px-4 py-2 border border-gray-300">Pedidos</th>
                            <th class="px-4 py-2 border border-gray-300">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">Mesa 1</td>
                            <td class="px-4 py-2 text-green-500 border border-gray-300">Livre</td>
                            <td class="px-4 py-2 border border-gray-300">-</td>
                            <td class="px-4 py-2 border border-gray-300">
                                <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300">Mesa 2</td>
                            <td class="px-4 py-2 text-yellow-500 border border-gray-300">Ocupada</td>
                            <td class="px-4 py-2 border border-gray-300">2</td>
                            <td class="px-4 py-2 border border-gray-300">
                                <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                            </td>
                        </tr>
                        <!-- Mais mesas aqui -->
                    </tbody>
                </table>
            </div>

            <!-- Acesso Rápido -->
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-4 text-lg font-medium text-gray-700">Acesso Rápido</h3>
                <div class="flex space-x-4">
                    <a href="{{ route('table.index') }}"
                        class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Gerenciar Mesas</a>
                    <a href="{{ route('table.index') }}"
                        class="px-4 py-2 text-white bg-green-500 rounded-lg hover:bg-green-600">Visualizar Pedidos</a>
                    <a href="{{ route('table.index') }}"
                        class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">Relatórios</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
