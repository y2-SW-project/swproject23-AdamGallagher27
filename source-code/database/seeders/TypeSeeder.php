<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Types;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $electric = new Types();
        $electric->type = 'electric';
        $electric->save();

        $accoustic = new Types();
        $accoustic->type = 'accoustic';
        $accoustic->save();

        $classical = new Types();
        $classical->type = 'classical';
        $classical->save();

        $bass = new Types();
        $bass->type = 'bass';
        $bass->save();

        $hollow = new Types();
        $hollow->type = 'hollow';
        $hollow->save();
    }
}
