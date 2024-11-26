<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Nova Mesa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-800 mb-4">Cadastro de Mesa</h3>

                    <!-- Formulário de Criação -->
                    <form method="POST" action="{{ route('table.store') }}">
                        @csrf

                        <!-- Nome da Mesa -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome da Mesa</label>
                            <input type="text" name="name" id="name" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                   placeholder="Ex.: Mesa 1" required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status da Mesa -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="free">Livre</option>
                                <option value="occupied">Ocupada</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="flex justify-end">
                            <a href="{{ route('table.index') }}"
                               class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                                Cancelar
                            </a>
                            <button type="submit" 
                                    class="ml-3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
