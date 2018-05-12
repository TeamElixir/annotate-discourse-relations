<?php

namespace App\Http\Controllers\api;

use App\Sentence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SentencesController extends Controller
{
    public function search()
    {
        $sentences = Sentence::orderBy('id')
            ->when(request('q'), function ($query) {
                $query->where('id', '=', request('q'));
            })
            ->get();

        return response()
            ->json(['sentences' => $sentences]);
    }
}
