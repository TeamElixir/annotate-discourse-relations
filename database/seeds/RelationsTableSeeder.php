<?php

use Illuminate\Database\Seeder;
use App\Relation;

class RelationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Relation::truncate();

        Relation::create([
            'id' => 1,
            'relation' => 'No Relation',
            'description' => 'There\'s no relation between the first sentence and the second',
            'text_span_1' => '',
            'text_span_2' => '',
            'simple_relation_id' => 1
        ]);

        Relation::create([
            'id' => 2,
            'relation' => 'Identity',
            'description' => 'The same text appears in more than one location',
            'text_span_1' => 'Tony Blair was elected for a second term today.',
            'text_span_2' => 'Tony Blair was elected for a second term today.',
            'simple_relation_id' => 3
        ]);

        Relation::create([
            'id' => 3,
            'relation' => 'Equivalence (Paraphrase)',
            'description' => 'Two text spans have the same information content',
            'text_span_1' => 'Derek Bell is experiencing a resurgence in his career.',
            'text_span_2' => 'Derek Bell is having a ”comeback year.”',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 4,
            'relation' => 'Translation',
            'description' => 'Same information content in different languages',
            'text_span_1' => 'Shouts of “Viva la revolucion!” echoed through the night.',
            'text_span_2' => 'The rebels could be heard shouting, “Long live the revolution”.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 5,
            'relation' => 'Subsumption',
            'description' => 'S1 contains all information in S2, plus additional information not in S2',
            'text_span_1' => 'With 3 wins this year, Green Bay has the best record in the NFL',
            'text_span_2' => 'Green Bay has 3 wins this year.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 6,
            'relation' => 'Contradiction',
            'description' => 'Conflicting information',
            'text_span_1' => 'There were 122 people on the downed plane.',
            'text_span_2' => '126 people were aboard the plane.',
            'simple_relation_id' => 5
        ]);

        Relation::create([
            'id' => 7,
            'relation' => 'Historical Background',
            'description' => 'S1 gives historical context to information in S2',
            'text_span_1' => 'This was the fourth time a member of the Royal Family has gotten divorced.',
            'text_span_2' => 'The Duke of Windsor was divorced from the Duchess of Windsor yesterday.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 8,
            'relation' => 'Citation',
            'description' => 'S1 explicitly cites document S2',
            'text_span_1' => 'An earlier article quoted Prince Albert as saying “I never gamble.”',
            'text_span_2' => 'Prince Albert then went on to say, “I never gamble.”',
            'simple_relation_id' => 4
        ]);

        Relation::create([
            'id' => 9,
            'relation' => 'Modality',
            'description' => 'S1 presents a qualified version of the information in S2, e.g., using “allegedly”',
            'text_span_1' => 'Sean “Puffy” Combs is reported to own several multimillion dollar estates.',
            'text_span_2' => 'Puffy owns four multimillion dollar homes in the New York area.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 10,
            'relation' => 'Attribution',
            'description' => 'S1 presents an attributed version of information in S2, e.g. using “According to CNN,”',
            'text_span_1' => 'According to a top Bush advisor, the President was alarmed at the news.',
            'text_span_2' => 'The President was alarmed to hear of his daughter’s low grades.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 11,
            'relation' => 'Summary',
            'description' => 'S1 summarizes S2.',
            'text_span_1' => 'The Mets won the Title in seven games.',
            'text_span_2' => 'After a grueling first six games, the Mets came from behind tonight to take the Title. So far, no',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 12,
            'relation' => 'Follow-up',
            'description' => 'S1 presents additional information which has happened since S2',
            'text_span_1' => '102 casualties have been reported in the earthquake region.',
            'text_span_2' => 'So far, no casualties from the quake have been confirmed.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 13,
            'relation' => 'Indirect speech',
            'description' => 'S1 indirectly quotes something which was directly quoted in S2',
            'text_span_1' => 'Mr. Cuban then gave the crowd his personal guarantee of free Chalupas.',
            'text_span_2' => '“I’ll personally guarantee free Chalupas,” Mr. Cuban announced to the crowd.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 14,
            'relation' => 'Elaboration (Refinement)',
            'description' => 'S1 elaborates or provides details of some information given more generally in S2',
            'text_span_1' => '50% of students are under 25; 20% are between 26 and 30; the rest are over 30.',
            'text_span_2' => 'Most students at the University are under 30.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 15,
            'relation' => 'Fulfillment',
            'description' => 'S1 asserts the occurrence of an event predicted in S2',
            'text_span_1' => 'After traveling to Austria Thursday, Mr. Green returned home to New York.',
            'text_span_2' => 'Mr. Green will go to Austria Thursday.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 16,
            'relation' => 'Description',
            'description' => 'S1 describes an entity mentioned in S2',
            'text_span_1' => 'Greenfield, a retired general and father of two, has declined to comment.',
            'text_span_2' => 'Mr. Greenfield appeared in court yesterday.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 17,
            'relation' => 'Reader Profile',
            'description' => 'S1 and S2 provide similar information written for a different audience.',
            'text_span_1' => 'The Durian, a fruit used in Asian cuisine, has a strong smell.',
            'text_span_2' => 'The dish is usually made with Durian.',
            'simple_relation_id' => 2
        ]);

        Relation::create([
            'id' => 18,
            'relation' => 'Change of perspective',
            'description' => 'The same entity presents a differing opinion or presents a fact in a different light.',
            'text_span_1' => 'Giuliani criticized the Officer’s Union as “too demanding” in contract talks.',
            'text_span_2' => 'Giuliani praised the Officer’s Union, which provides legal aid and advice to members.',
            'simple_relation_id' => 5
        ]);

        Relation::create([
            'id' => 19,
            'relation' => 'Overlap (partial equivalence)',
            'description' => 'S1 provides facts X and Y while S2 provides facts X and Z; X, Y, and Z should all be non-trivial.',
            'text_span_1' => 'The plane crashed into the 25th floor of the Pirelli building in downtown Milan.',
            'text_span_2' => 'A small tourist plane crashed into the tallest building in Milan.',
            'simple_relation_id' => 2
        ]);
    }
}
