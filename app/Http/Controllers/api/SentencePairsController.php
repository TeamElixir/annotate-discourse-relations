<?php

namespace App\Http\Controllers\api;

use App\Sentence;
use App\SentencePair;
use App\Http\Controllers\Controller;

class SentencePairsController extends Controller
{
    public static $relations = [
        1 => 'Elaboration',
        2 => 'Subsumption',
        3 => 'Contradiction',
        4 => 'No Relation'
    ];


    public static function search()
    {
        $sentence_pairs = SentencePair::orderBy('id')
            ->when(request('q'), function ($query) {
                $query->where('id', '=', request('q'));
            })
            ->get();

        foreach ($sentence_pairs as $sentence_pair) {
            $source_sentence = Sentence::find($sentence_pair["source_sntc_id"]);
            $target_sentence = Sentence::find($sentence_pair["target_sntc_id"]);
            $sentence_pair["source_sntc"] = $source_sentence;
            $sentence_pair["target_sntc"] = $target_sentence;
        }

        return response()
            ->json(['pair' => $sentence_pairs]);
    }
}
