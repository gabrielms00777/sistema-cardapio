<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
            'password' => 'admin',
        ]);

        // $order = App\Models\Order::create(['table_id' => 1,'name' => 'Test Order','total_price' => '100'])
        // App\Models\OrderItem::query()->create(['order_id' => 1,'menu_item_id' => 1,'quantity' => 1,'price' => 100,'observation' => 'oiiii',]);
        $this->call([
            // CategorySeeder::class,
            TableSeeder::class,
            MenuItemSeeder::class,
        ]);
    }
}
