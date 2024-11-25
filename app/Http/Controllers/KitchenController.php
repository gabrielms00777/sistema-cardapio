<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KitchenController extends Controller
{
    public function index(Request $request)
    {

        // $orders = Order::query()
        //     // ->withAggregate('table', 'number', 'table_number')
        //     ->whereDate('created_at', '=', Carbon::today()->toDateString())
        //     // ->where('status', '=', 'pending')
        //     ->where('status', '<>', 'ready')
        //     ->with(['items.menuItem', 'table'])
        //     // ->with('items', function ($query) {
        //     //     $query->whereNot('status', 'ready');
        //     // })
        //     // ->with('items.menuItem')
        //     // ->with('table')
        //     ->get();
        // // dd($orders);

        // if ($request->ajax()) {
        //     return response()->json([
        //         'orders' => $orders,
        //     ]);
        // }

        return view('kitchen.index', [
            // 'orders' => $orders,
        ]);
    }

    public function orders(Request $request)
    {

        $orders = Order::query()
            // ->withAggregate('table', 'number', 'table_number')
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->where('status', '<>', 'ready')
            ->with(['items.menuItem', 'table'])
            ->get();
        // dd($orders);

        return response()->json($orders);

    }

    public function updateItemStatus(Request $request, OrderItem $item)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,delivered,cancelled',
        ]);

        $item->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,in_preparation,ready,delivered',
        ]);

        $order->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
