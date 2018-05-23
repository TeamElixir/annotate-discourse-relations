<?php

namespace App\Http\Controllers;

use App\Relation;
use App\SentencePair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class SentencePairsController extends Controller
{
    public static function getAllSentencePairs()
    {
        $all_sentence_pairs = SentencePair::paginate(5);

        return $all_sentence_pairs;
    }

    public static function getSentencePairsForUser($user_id){
        
    }
}
