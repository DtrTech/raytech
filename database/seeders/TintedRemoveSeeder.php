<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\RemoveTintSetting;


class TintedRemoveSeeder extends Seeder
{

    public function run()
    {
        RemoveTintSetting::truncate();
        RemoveTintSetting::create([
            'fws'=>1,
            'rws'=>1,
            'l1'=>1,
            'l2'=>1,
            'l3'=>1,
            'r1'=>1,
            'r2'=>1,
            'r3'=>1,
            'srf'=>1,
        ]);
    }
}