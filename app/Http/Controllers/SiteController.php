<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function home()
    {
        // $categories = [
        //     [
        //         'id' => 1,
        //         'label' => 'Carnes',
        //         'items' => [
        //             [
        //                 'id' => 1,
        //                 'name' => 'Picanha',
        //                 'description' => 'Picanha grelhada com farofa e vinagrete',
        //                 'price' => 'R$ 59,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 2,
        //                 'name' => 'Costela',
        //                 'description' => 'Costela ao molho barbecue com batatas rústicas',
        //                 'price' => 'R$ 49,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 3,
        //                 'name' => 'Fraldinha',
        //                 'description' => 'Fraldinha grelhada com chimichurri',
        //                 'price' => 'R$ 54,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 4,
        //                 'name' => 'Maminha',
        //                 'description' => 'Maminha ao ponto com arroz e farofa',
        //                 'price' => 'R$ 47,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //         ],
        //     ],
        //     [
        //         'id' => 2,
        //         'label' => 'Bebidas',
        //         'items' => [
        //             [
        //                 'id' => 5,
        //                 'name' => 'Refrigerante',
        //                 'description' => 'Coca-Cola lata 350ml',
        //                 'price' => 'R$ 5,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 6,
        //                 'name' => 'Água',
        //                 'description' => 'Água mineral sem gás 500ml',
        //                 'price' => 'R$ 3,50',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 7,
        //                 'name' => 'Suco Natural',
        //                 'description' => 'Suco de laranja natural 300ml',
        //                 'price' => 'R$ 7,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 8,
        //                 'name' => 'Cerveja',
        //                 'description' => 'Cerveja long neck 355ml',
        //                 'price' => 'R$ 9,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //         ],
        //     ],
        //     [
        //         'id' => 3,
        //         'label' => 'Sobremesas',
        //         'items' => [
        //             [
        //                 'id' => 9,
        //                 'name' => 'Petit Gâteau',
        //                 'description' => 'Petit gâteau com sorvete de creme',
        //                 'price' => 'R$ 19,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 10,
        //                 'name' => 'Pudim',
        //                 'description' => 'Pudim de leite condensado',
        //                 'price' => 'R$ 12,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 11,
        //                 'name' => 'Torta de Limão',
        //                 'description' => 'Torta de limão com chantilly',
        //                 'price' => 'R$ 14,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //             [
        //                 'id' => 12,
        //                 'name' => 'Brownie',
        //                 'description' => 'Brownie de chocolate com nozes',
        //                 'price' => 'R$ 16,90',
        //                 'image' => 'https://via.placeholder.com/100',
        //             ],
        //         ],
        //     ],
        // ];

        $categories = Category::query()->with('menuItems')->select('id', 'name')->get();

        // dd($categories);

        return view('site.home', [
            'categories' => $categories,
        ]);
    }

    public function product(MenuItem $product)
    {
        // $product = [
        //     'id' => '1',
        //     'name' => 'Picanha',
        //     'description' => 'Picanha grelhada com farofa e vinagrete',
        //     'price' => 59.9,
        //     'image' => 'https://via.placeholder.com/300',
        // ];
        // dd($product);
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
        $data = $request->validate([
            'table_id' => 'required',
            'name' => 'required',
            'items' => 'required|array',
            'total_price' => 'required|numeric',
            // 'items.*.menu_item_id' => 'required|integer|exists:menu_items,id',
            // 'items.*.quantity' => 'required|integer|min:1',
            // 'items.*.price' => 'required|numeric',
            // 'items.*.observation' => 'nullable|string',
        ]);

        $order = Order::query()->create([
            'table_id' => $data['table_id'],
            'name' => $data['name'],
            'total_price' => $data['total_price'],
        ]);

        foreach ($data['items'] as $item) {
            OrderItem::query()->create([
                'order_id' => $order->id,
                'menu_item_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'observation' => $item['observation'],
            ]);
        }

        // broadcast(new OrderCreated($order))->toOthers();

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
