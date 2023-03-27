<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Condition;


class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new = new Condition();
        $new->condition = 'brand new';
        $new->save();

        $great = new Condition();
        $great->condition = 'great';
        $great->save();

        $good = new Condition();
        $good->condition = 'good';
        $good->save();

        $fair = new Condition();
        $fair->condition = 'fair';
        $fair->save();

        $bad = new Condition();
        $bad->condition = 'bad';
        $bad->save();
    }
}
