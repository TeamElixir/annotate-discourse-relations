<?php

namespace App\Http\Controllers;

use App\Relation;
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
        $relations = Relation::all();
        $sentence_pairs = SentencePairsController::getAllSentencePairs();
        return view('welcome', [
            'sentence_pairs' => $sentence_pairs,
            'auth_user' => $auth_user,
            'relations' => $relations
        ]);
    }
}
