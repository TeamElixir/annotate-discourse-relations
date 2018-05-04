<?php

namespace App\Http\Controllers;

use App\Sentence;
use Illuminate\Http\Request;

class SentencesController extends Controller
{
    public function getAllSentences() {
        $all_sentences = Sentence::all();
        return $all_sentences;
    }

    public static function getSentenceById($id) {
        $sentence = Sentence::find($id);
        return $sentence;
    }
}
