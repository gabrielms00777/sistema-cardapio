<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciamento de Mesas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Título -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-800">Lista de Mesas</h3>
                        <a href="{{ route('table.create') }}"
                           class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Adicionar Mesa
                        </a>
                    </div>

                    <!-- Tabela de Mesas -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Número</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tables as $table)
                                    <tr class="border-b">
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $table->id }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $table->number }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full {{ $table->status == 'free' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }}">
                                                {{ $table->status == 'free' ? 'Livre' : 'Ocupada' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            <a href="{{ route('table.qrcode', $table->id) }}"
                                               class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                QR Code
                                            </a>
                                            <a href="{{ route('table.edit', $table->id) }}"
                                               class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                                Editar
                                            </a>
                                            <form action="{{ route('table.destroy', $table->id) }}" method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('Tem certeza que deseja excluir esta mesa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-700">
                                            Nenhuma mesa cadastrada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
