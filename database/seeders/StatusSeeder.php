<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    public function run(): void
    {
        Status::create(
            [
                'name' => [
                    'uz' => "Yangi",
                    'ru' => 'Новый',
                ],
                'code' => 'new',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Tasdiqlandi",
                    'ru' => 'Потвержден',
                ],
                'code' => 'confirmed',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Bajarilmoqda",
                    'ru' => 'В процессе',
                ],
                'code' => 'processing',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Yetkazib berish jarayonida",
                    'ru' => 'В процессе доставки',
                ],
                'code' => 'shipping',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Yetkazib berildi",
                    'ru' => 'Доставлен',
                ],
                'code' => 'delivered',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Tugatildi",
                    'ru' => 'Завершен',
                ],
                'code' => 'completed',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Yopildi",
                    'ru' => 'Закрыт',
                ],
                'code' => 'closed',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Bekor qilindi",
                    'ru' => 'Отменен',
                ],
                'code' => 'canceled',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "Qaytarildi",
                    'ru' => 'Возврат',
                ],
                'code' => 'refunded',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "To'lov kutilmoqda",
                    'ru' => 'Ожидание платежа',
                ],
                'code' => 'waiting_payment',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "To'landi",
                    'ru' => 'Оплачен',
                ],
                'code' => 'paid',
                'for' => 'order',
            ]
        );

        Status::create(
            [
                'name' => [
                    'uz' => "To'lovda xato",
                    'ru' => 'Ошибка при оплате',
                ],
                'code' => 'payment_error',
                'for' => 'order',
            ]
        );


    }
}
