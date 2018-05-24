<?php

use Illuminate\Database\Seeder;
use App\SimpleRelation;

class SimpleRelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SimpleRelation::truncate();

        SimpleRelation::create([
            'id' => '1',
            'relation' => 'No Relation',
        ]);

        SimpleRelation::create([
            'id' => '2',
            'relation' => 'Elaboration',
        ]);

        SimpleRelation::create([
            'id' => '3',
            'relation' => 'Redundancy',
        ]);

        SimpleRelation::create([
            'id' => '4',
            'relation' => 'Citation',
        ]);

        SimpleRelation::create([
            'id' => '5',
            'relation' => 'Shift in View',
        ]);

    }
}
