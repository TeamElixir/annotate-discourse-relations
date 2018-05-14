<?php

namespace App\Http\Controllers;

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
        $sentence_pairs = SentencePairsController::getAllSentencePairs();
        return view('welcome', [
            'sentence_pairs' => $sentence_pairs,
        ]);
    }
}
