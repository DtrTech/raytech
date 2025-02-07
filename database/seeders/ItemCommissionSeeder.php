<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\ItemCommission;


class ItemCommissionSeeder extends Seeder
{

    public function run()
    {
        ItemCommission::truncate();
        ItemCommission::create([
            'type'=>'sale',
            'rate'=>20,
        ]);
        ItemCommission::create([
            'type'=>'work',
            'rate'=>10,
        ]);
    }
}