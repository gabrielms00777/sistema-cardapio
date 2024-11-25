<?php

namespace App\Livewire\Kitchen;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Orders extends Component
{
    public function updateItemStatus(int $itemId, string $status)
    {
        // dd($itemId, $status);
        $item = OrderItem::findOrFail($itemId);
        $item->update(['status' => $status]);

        if ($status == 'ready') {
            $order = $item->order;
            if ($order->items->every(fn ($item) => $item->status == 'ready')) {
                $order->update(['status' => 'ready']);
                $this->orders();
            }
        }
    }

    #[On('echo:orders,OrderCreated')]
    public function orderCreatedEvent()
    {
        $this->orders();
    }

    // #[On('order-updated')]

    #[Computed()]
    public function orders()
    {
        return Order::query()
        // ->withAggregate('table', 'number', 'table_number')
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->where('status', '<>', 'ready')
            ->with(['items.menuItem', 'table'])
            ->get();
    }

    // #[On('echo:orders,OrderCreated')]
    public function render()
    {
        // $orders = Order::query()
        // ->withAggregate('table', 'number', 'table_number')
        // ->whereDate('created_at', '=', Carbon::today()->toDateString())
        // ->where('status', '<>', 'ready')
        // ->with(['items.menuItem', 'table'])
        // ->get();
        // dd($orders);

        // return view('livewire.kitchen.orders', compact('orders'));
        return view('livewire.kitchen.orders');
    }
}
