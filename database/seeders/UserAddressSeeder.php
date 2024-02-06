<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserAddressSeeder extends Seeder
{

    public function run(): void
    {
        User::find(2)->addresses()->create([
            "latitude"=> "41.12020",
            "longitude"=> "41.2020",
            "region"=> "Tashkent",
            "district"=> "Olmazor",
            "street"=> "Amir-Temur",
            "home"=> "1a2a",
    ]);
        User::find(2)->addresses()->create([
            "latitude" => "41.12020",
            "longitude" => "98.2020",
            "region" => "Tashkent",
            "district" => "Chilonzor",
            "street" => "Muquqmiy",
            "home" => "1a223",
    ]);
    }
}
