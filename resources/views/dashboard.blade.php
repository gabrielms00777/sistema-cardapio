<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard do Gerente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Resumo Rápido -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-700">Total de Mesas</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">15</p>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-700">Pedidos Pendentes</h3>
                    <p class="mt-2 text-3xl font-bold text-yellow-500">8</p>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-700">Total Arrecadado (Hoje)</h3>
                    <p class="mt-2 text-3xl font-bold text-green-500">R$ 1.234,56</p>
                </div>
            </div>

            <!-- Tabelas de Detalhes -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Resumo das Mesas</h3>
                <table class="w-full border-collapse border border-gray-300 text-left text-sm">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">Mesa</th>
                            <th class="border border-gray-300 px-4 py-2">Status</th>
                            <th class="border border-gray-300 px-4 py-2">Pedidos</th>
                            <th class="border border-gray-300 px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Mesa 1</td>
                            <td class="border border-gray-300 px-4 py-2 text-green-500">Livre</td>
                            <td class="border border-gray-300 px-4 py-2">-</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">Mesa 2</td>
                            <td class="border border-gray-300 px-4 py-2 text-yellow-500">Ocupada</td>
                            <td class="border border-gray-300 px-4 py-2">2</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="#" class="text-blue-500 hover:underline">Ver Detalhes</a>
                            </td>
                        </tr>
                        <!-- Mais mesas aqui -->
                    </tbody>
                </table>
            </div>

            <!-- Acesso Rápido -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-700 mb-4">Acesso Rápido</h3>
                <div class="flex space-x-4">
                    <a href="{{ route('table.index') }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Gerenciar Mesas</a>
                    <a href="{{ route('table.index') }}"
                       class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Visualizar Pedidos</a>
                    <a href="{{ route('table.index') }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Relatórios</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
