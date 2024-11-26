<?php

namespace App\Livewire\Table;

use App\Models\Order;
use App\Models\Table;
use Livewire\Component;

class ListOrders extends Component
{
    public $tables;

    public $selectedTable = null;

    public function mount()
    {
        $this->tables = Table::with('orders')->get();
    }

    public function selectTable($tableId)
    {
        $this->selectedTable = $this->tables->find($tableId);
        $this->selectedTable->load([
            'orders' => function ($query) {
                $query->where('session_id', $this->selectedTable->session_id);
            },
            'orders.items',
            'orders.items.menuItem'
        ]);
    }

    public function payPerson($name, $tableId)
    {
        $table = Table::query()->select('id', 'session_id')->find($tableId);
        Order::query()
            ->where('name', $name)
            ->where('table_id', $table->id)
            ->where('session_id', $table->session_id)
            ->update(['status' => 'paid']);

        $this->selectedTable = Table::with([
            'orders' => function ($query) {
                $query->where('session_id', $this->selectedTable->session_id);
            },
            'orders.items',
            'orders.items.menuItem'
        ])->find($tableId);
    }

    public function finalizeTable($tableId)
    {
        $table = Table::query()->select('id', 'session_id')->find($tableId);

        Order::where('table_id', $table->id)
            ->where('session_id', $table->session_id)
            ->update(['status' => 'paid']);
            
            $table->update([
                'status' => 'free',
                'session_id' => null,
            ]);
            $this->selectedTable = Table::with([
                'orders' => function ($query) {
                    $query->where('session_id', $this->selectedTable->session_id);
                },
                'orders.items',
                'orders.items.menuItem'
            ])->find($tableId);
    }

    public function render()
    {
        return view('livewire.table.list-orders');
    }
}
