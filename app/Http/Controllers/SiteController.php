<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        // if(!Session::has('table_id')) {
        //     return view('site.index');
        // }
        return view('site.index');
    }

    public function token(Request $request)
    {
        $table = Table::query()->where('token', $request->token)->firstOrFail();
        // dd($table);
        session([
            'table_id' => $table->id,
            'expires_at' => now()->addMinutes(5),
        ]);

        return to_route('site.home');
    }

    public function home()
    {
        if(!Session::has('table_id')) {
            return to_route('site.index');
        }

        $categories = Category::query()->with('menuItems')->select('id', 'name')->get();

        return view('site.home', [
            'categories' => $categories,
        ]);
    }


    public function product(MenuItem $product)
    {
        return view('site.product', [
            'product' => $product,
        ]);
    }

    public function cart()
    {
        return view('site.cart');
    }

    public function order(Request $request)
    {
        if(!Session::has('table_id')) {
            return to_route('site.index');
        }
        $data = $request->validate([
            // 'table_id' => 'required',
            'name' => 'required',
            'items' => 'required|array',
            'total_price' => 'required|numeric',
            // 'items.*.menu_item_id' => 'required|integer|exists:menu_items,id',
            // 'items.*.quantity' => 'required|integer|min:1',
            // 'items.*.price' => 'required|numeric',
            // 'items.*.observation' => 'nullable|string',
        ]);

        $order = Order::query()->create([
            // 'table_id' => $data['table_id'],
            'table_id' => Session::get('table_id'),
            'name' => $data['name'],
            'total_price' => $data['total_price'],
        ]);
        // info($order);
        
        $table = $order->table;
        // info($table);

        if ($table->status == 'free') {
            $table->update([
                'status' => 'occupied',
                'session_id' => Str::ulid(),
            ]);
            // Table::query()->where('id', $data['table_id'])->update([
            //     'status' => 'occupied',
            //     'session_id' => Str::ulid(),
            // ]);
        }
        // info($table);

        $order->update([
            'session_id' => $table->session_id,
        ]);

        // info($order);

        foreach ($data['items'] as $item) {
            OrderItem::query()->create([
                'order_id' => $order->id,
                'menu_item_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'observation' => $item['observation'],
            ]);
        }

        broadcast(new OrderCreated)->toOthers();

        return response()->noContent();
        // return response()->json(['success' => true]);
    }

    public function name()
    {
        return view('site.name');
    }

    public function confirmation()
    {
        return view('site.confirmation');
    }
}
