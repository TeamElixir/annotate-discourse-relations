<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getHomePage()
    {
        $sentence_pairs = SentencePairsController::getAllSentencePairs();
        return view('welcome', [
            'sentence_pairs' => $sentence_pairs
        ]);
    }
}
