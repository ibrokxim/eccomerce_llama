<?php

namespace Database\Seeders;

use App\Models\DeliveryMethod;
use Illuminate\Database\Seeder;

class DeliveryMethodSeeder extends Seeder
{

    public function run(): void
    {
        DeliveryMethod::create(
            [
                'name' => [
                    'uz' => 'Tekin',
                    'ru' => 'Бесплатный',
                ],
                'estimated_time' => [
                    'uz' => '5 kun',
                    'ru' => '5 дней',
                ],
                'sum' => 0,
            ]
        );
        DeliveryMethod::create(
            [
                'name' => [
                    'uz' => 'Standart',
                    'ru' => 'Стандартный',
                ],
                'estimated_time' => [
                    'uz' => '3 kun',
                    'ru' => '3 дня',
                ],
                'sum' => 50000,
            ]
        );
        DeliveryMethod::create(
            [
                'name' => [
                    'uz' => 'Tezkor',
                    'ru' => 'Быстрый',
                ],
                'estimated_time' => [
                    'uz' => '1 kun',
                    'ru' => '1 день',
                ],
                'sum' => 100000,
            ]
        );
    }
}
