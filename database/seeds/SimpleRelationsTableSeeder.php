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
            'description' => 'There is no relationship between the two sentences. This occurs as one 
            sentence discusses a topic which is different from the topic discussed in other sentence.',
        ]);

        SimpleRelation::create([
            'id' => '2',
            'relation' => 'Elaboration',
            'description' => 'one sentence adds more details to the information provided in a previous sentence.
            It can also be described as one sentence develops further on the topic discussed in the previous sentence.',
        ]);

        SimpleRelation::create([
            'id' => '3',
            'relation' => 'Redundancy',
            'description' => 'Two sentences provide same information without any difference or additional information. 
            (The same text appears in more than one location)',
        ]);

        SimpleRelation::create([
            'id' => '4',
            'relation' => 'Citation',
            'description' => 'Sentence 2 provides a citation to sentence 1.
',
        ]);

        SimpleRelation::create([
            'id' => '5',
            'relation' => 'Shift in View',
            'description' => 'When the details provided by one sentence is in a different view from the other sentence. 
            This happens because two sentences are providing conflicting information or opinions on a same topic or entity.',
        ]);

    }
}
