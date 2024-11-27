<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    private static $tableNumber = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => self::$tableNumber++,
            'status' => 'free',
            'token' => Str::uuid(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($table) {
            $url = route('site.token', ['token' => $table->token]);
            $qrcode = QrCode::size(200)->generate($url);

            $table->update([
                'qrcode' => $qrcode,
            ]);
        });
    }
}
