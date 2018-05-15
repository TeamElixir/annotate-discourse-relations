<?php

namespace App\Http\Controllers;

use App\Relation;
use App\SentencePair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SentencePairsController extends Controller
{
    public static $relations = array();

    private static function populateRelationsArray() {
        $all_relations = Relation::all();
        foreach ($all_relations as $relation) {
            self::$relations[$relation->id] = $relation->relation;
        }
    }


    public static function getAllSentencePairs()
    {
        self::populateRelationsArray();
        $all_sentence_pairs = SentencePair::all();
        $pairs = array();
        foreach ($all_sentence_pairs as $sentence_pair) {
            $pair_object = self::getSentencePairById($sentence_pair->id);

            array_push($pairs, $pair_object);
        }

        return $pairs;
    }

    public static function getSentencePairById($pair_id)
    {
        self::populateRelationsArray();

        // all annotations by the currently logged in user
        $auth_users_annotations = AnnotationsController::getAnnotationsOfuser(Auth::user()->id);
        $user_already_annotated = false;

        foreach ($auth_users_annotations as $annotation) {
            if ($annotation->pair_id == $pair_id) {
                $user_already_annotated = true;
            }
        }

        $sentence_pair = SentencePair::find($pair_id);
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
