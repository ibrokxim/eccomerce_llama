<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::create([
            "name" => [
                "uz" => 'Stol',
                "ru" => 'Стол' ,
            ]
        ]);

        Category::create([
            "name" => [
                "uz" => 'Divan',
                "ru" => 'Диван' ,
            ]
        ]);

        $category = Category::create([
            "name" => [
                "uz" => 'Kreslo',
                "ru" => 'Кресло' ,
            ]
        ]);
        $category->childCategories()->create([
            "name" => [
                "uz" => 'Offis',
                "ru" => 'Офис' ,
            ]
        ]);
        $childCategory = $category->childCategories()->create([
            "name" => [
                "uz" => 'Gaming',
                "ru" => 'Игровые' ,
            ]
        ]);
        $childCategory->childCategories()->create([
            "name" => [
                "uz" => 'Rgb',
                "ru" => 'Rgb' ,
            ]
        ]);
        $category->childCategories()->create([
            "name" => [
                "uz" => 'Uy uchun',
                "ru" => 'Для дома' ,
            ]
        ]);

        Category::create([
            "name" => [
                "uz" => 'Yotoq',
                "ru" => 'Кровать' ,
            ]
        ]);
        Category::create([
            "name" => [
                "uz" => 'Stul',
                "ru" => 'Стул' ,
            ]
        ]);
    }
}
