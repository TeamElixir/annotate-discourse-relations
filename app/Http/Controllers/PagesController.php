<?php

namespace App\Http\Controllers;

use App\Relation;
use App\SimpleRelation;
use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHomePage()
    {
        $auth_user = Auth::user();
        $original_relations = Relation::all();
        $simple_relations = SimpleRelation::all();
//        $sentence_pairs = SentencePairsController::getAllSentencePairs();
        $sentence_pairs = SentencePairsController::getSentencePairsForUser($auth_user->id);
        return view('welcome', [
            'sentence_pairs' => $sentence_pairs,
            'auth_user' => $auth_user,
            'original_relations' => $original_relations,
            'simple_relations' => $simple_relations
        ]);
    }
}
