<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Mesas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <livewire:table.list-orders />
    </div>
</x-app-layout>
