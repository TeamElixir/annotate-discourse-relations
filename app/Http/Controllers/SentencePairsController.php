<?php

namespace App\Http\Controllers;

use App\SentencePair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SentencePairsController extends Controller
{

    public static $relations = [
        1 => 'Elaboration',
        2 => 'Subsumption',
        3 => 'Contradiction',
        4 => 'No Relation'
    ];


    public static function getAllSentencePairs()
    {

        $all_sentence_pairs = SentencePair::all();
        $pairs = array();
        foreach ($all_sentence_pairs as $sentence_pair) {
            $pair_object = self::getSentencePairById($sentence_pair->id);

            array_push($pairs, $pair_object);
        }

        return $pairs;
    }

    public static function getSentencePairById($id)
    {
        // all annotations by the currently logged in user
        $auth_users_annotations = AnnotationsController::getAnnotationsOfuser(Auth::user()->id);
        $user_already_annotated = false;

        foreach ($auth_users_annotations as $annotation) {
            if ($annotation->id == $id) {
                $user_already_annotated = true;
            }
        }

        $sentence_pair = SentencePair::find($id);
        $source_sntc = SentencesController::getSentenceById($sentence_pair["source_sntc_id"]);
        $target_sntc = SentencesController::getSentenceById($sentence_pair["target_sntc_id"]);
        $relation_1 = self::$relations[$sentence_pair["relation_1"]];
        $relation_2 = self::$relations[$sentence_pair["relation_2"]];

        $pair_object = [
            'pair_id' => $sentence_pair->id,
            'source_sntc' => $source_sntc,
            'target_sntc' => $target_sntc,
            'relation_1' => $relation_1,
            'relation_2' => $relation_2,
            'user_already_annotated' => $user_already_annotated
        ];

        return $pair_object;
    }
}
