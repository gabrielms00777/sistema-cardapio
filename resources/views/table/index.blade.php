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
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-800">Mesas do Estabelecimento</h3>
                        <a href="{{ route('table.create') }}"
                           class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Adicionar Mesa
                        </a>
                    </div>

                    <!-- Grade de Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($tables as $table)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-md p-4 flex flex-col justify-between">
                                <!-- Nome da Mesa -->
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Mesa {{ $table->number }}</h4>
                                    <!-- QR Code -->
                                    <div class="mb-4">
                                        <span class="w-20 h-20 object-contain mx-auto cursor-pointer">

                                            {!! $table->qrcode !!}
                                        </span>
                                        {{-- <img src="{{ $table->qrcode }}" alt="QR Code da Mesa" class="w-20 h-20 object-contain mx-auto cursor-pointer"
                                             onclick="showQrCode('{{ $table->qrcode }}')"> --}}
                                    </div>
                                    <!-- Status -->
                                    <div class="text-sm mb-4">
                                        <span
                                            class="px-3 py-1 text-xs rounded-full {{ $table->status == 'free' ? 'bg-green-200 text-green-700' : 'bg-red-200 text-red-700' }}">
                                            {{ $table->status == 'free' ? 'Livre' : 'Ocupada' }}
                                        </span>
                                    </div>
                                </div>
                                <!-- Botões de Ação -->
                                <div class="flex justify-between">
                                    <a href="{{ route('table.edit', $table->id) }}"
                                       class="px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                        Editar
                                    </a>
                                    <form action="{{ route('table.destroy', $table->id) }}" method="POST"
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta mesa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-2 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-700">
                                Nenhuma mesa cadastrada.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para QR Code -->
    <div id="qrcodeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6 relative">
            <button onclick="closeQrCode()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">
                &times;
            </button>
            <h3 class="text-lg font-medium text-gray-700 mb-4">QR Code da Mesa</h3>
            <img id="qrcodeImage" src="" alt="QR Code" class="w-full h-auto mb-4">
            <button onclick="printQrCode()" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Imprimir QR Code
            </button>
        </div>
    </div>

    <script>
        function showQrCode(url) {
            document.getElementById('qrcodeImage').src = url;
            document.getElementById('qrcodeModal').classList.remove('hidden');
        }

        function closeQrCode() {
            document.getElementById('qrcodeModal').classList.add('hidden');
        }

        function printQrCode() {
            const printWindow = window.open('', '_blank');
            const qrCodeImage = document.getElementById('qrcodeImage').src;
            printWindow.document.write(`<img src="${qrCodeImage}" style="width:100%;height:auto;">`);
            printWindow.document.close();
            printWindow.print();
        }
    </script>
</x-app-layout>
