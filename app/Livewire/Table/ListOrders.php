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
        $this->selectedTable = $this->tables->find($tableId); // Encontra a mesa selecionada
        $this->selectedTable->load(['orders', 'orders.items', 'orders.items.menuItem']);
    }

    public function payPerson($name, $tableId)
    {
        $table = Table::query()->select('id', 'session_id')->find($tableId);
        $orders = Order::query()
            ->where('name', $name)
            ->where('table_id', $table->id)
            // ->where('session_id', $table->session_id)
            ->get();
        dd($table, $orders);
        // $order = Order::find($orderId);
        // $order->status = 'paid';
        // $order->save();

        // $this->selectedTable = Table::with('orders')->find($this->selectedTable->id);
    }

    public function finalizeTable($tableId)
    {
        $table = Table::query()->select('id', 'session_id')->find($tableId);

        $orders = Order::where('table_id', $table->id)
            ->where('session_id', $table->session_id)
            // ->get();
            ->update(['status' => 'paid']);

        // dd($orders);

        $table->update([
            'status' => 'free',
            'session_id' => null,
        ]);
        // $table = Table::find($tableId);
        // $table->status = 'free';
        // $table->save();

        // $this->tables = Table::with('orders')->get();
        // $this->selectedTable = null;
    }

    public function render()
    {
        return view('livewire.table.list-orders');
    }
}
