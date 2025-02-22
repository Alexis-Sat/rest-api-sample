<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food = Business::create([
            'name' => 'Еда',
            'parent_id' => '',
        ]);
        $auto = Business::create([
            'name' => 'Автомобили',
            'parent_id' => '',
        ]);

        $foodChild1 = Business::create(
            ['name' => 'Мясная продукция',
                'parent_id' => $food->id,

            ]);
        $foodChild2 = Business::create(
            ['name' => 'Молочная продукция',
                'parent_id' => $food->id,

            ]);
        $foodChildren1 = Business::create(
            ['name' => 'Молоко',
                'parent_id' => $foodChild1->id,

            ]);
        $autoChild1 = Business::create(
            ['name' => 'Легковые',
                'parent_id' => $auto->id,

            ]);

        $autoChild2 = Business::create(
            ['name' => 'Грузовые',
                'parent_id' => $auto->id,

            ]);

        $autoChildren1 = Business::create(
            ['name' => 'Запчасти',
                'parent_id' => $autoChild1->id,

            ]);

        $autoChildren2 = Business::create(
            ['name' => 'Аксессуары',
                'parent_id' => $autoChild2->id,

            ]);

        $businesses = Business::all();

        Organization::all()->each(function ($organization) use ($businesses) {
            $organization->business()->attach(
                $businesses->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }
}
