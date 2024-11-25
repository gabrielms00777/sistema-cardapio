<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mesas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex mx-auto space-x-6 max-w-7xl sm:px-6 lg:px-8" x-data="tableHandler()">
            <!-- Listagem de Mesas -->
            <div class="w-1/4 p-4 bg-gray-100 rounded-lg shadow-md">
                <h3 class="mb-4 text-lg font-semibold">Mesas</h3>
                <ul class="space-y-3">
                    <template x-for="table in tables" :key="table.id">
                        <li class="p-3 rounded-md cursor-pointer hover:bg-gray-200"
                            :class="{ 'bg-green-100': table.occupied, 'bg-white': !table.occupied }"
                            @click="selectTable(table)">
                            <div class="flex items-center justify-between">
                                <span class="font-medium">Mesa #<span x-text="table.id"></span></span>
                                <span x-text="table.occupied ? 'Ocupada' : 'Livre'"
                                    :class="table.occupied ? 'text-red-500' : 'text-green-500'">
                                </span>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
            <!-- Detalhes da Mesa Selecionada -->
            <div class="w-3/4 p-6 bg-white rounded-lg shadow-md" x-show="selectedTable">
                <template x-if="selectedTable.occupied">
                    <div>
                        <h3 class="mb-6 text-2xl font-semibold">Mesa #<span x-text="selectedTable.id"></span></h3>

                        <!-- Listagem de Pessoas -->
                        <template x-for="person in selectedTable.people" :key="person.id">
                            <div class="p-4 mb-4 rounded-lg shadow-md bg-gray-50">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-lg font-semibold" x-text="person.name"></p>
                                        <p>Total: R$ <span x-text="person.total.toFixed(2)"></span></p>
                                    </div>
                                    <div class="flex space-x-4">
                                        <button @click="viewDetails(person)"
                                            class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                            Detalhes
                                        </button>
                                        <button @click="payPerson(person)"
                                            class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                                            Pagar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Botão para Finalizar a Conta da Mesa -->
                        <div class="mt-8 text-right">
                            <button @click="payTable()"
                                class="px-6 py-3 text-white bg-red-500 rounded-lg hover:bg-red-600">
                                Finalizar Conta Completa
                            </button>
                        </div>
                    </div>
                </template>
                <!-- Mensagem quando a mesa está vazia -->
                <div x-show="!selectedTable.occupied" class="text-center text-gray-500">
                    <p>Esta mesa está livre.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
