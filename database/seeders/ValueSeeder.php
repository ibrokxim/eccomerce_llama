<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Value;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attribute = Attribute::find(1);

        $attribute->values()->create([
            "name" => json_encode([
                "uz" => "Qizil",
                "ru" => "Красный",
            ])
        ]);
        $attribute->values()->create([
            "name" => json_encode([
                "uz" => "Qora",
                "ru" => "Черынй",
            ])
        ]);
        $attribute->values()->create([
            "name" => json_encode([
                "uz" => "Jigarrang",
                "ru" => "Коричневый",
            ])
        ]);

        $attribute = Attribute::find(2);
        $attribute->values()->create([
            "name" => json_encode([
                "uz" => "MDF",
                "ru" => "МДФ",
            ])
        ]);
        $attribute->values()->create([
            "name" => json_encode([
                "uz" => "LDS",
                "ru" => "ЛДС",
            ])
        ]);
    }
}
