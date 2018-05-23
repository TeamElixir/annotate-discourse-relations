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

    public function tempPost(Request $request)
    {
        $id_of_pair_0 = $request->id_of_pair_0;
        $id_of_pair_1 = $request->id_of_pair_1;
        $id_of_pair_2 = $request->id_of_pair_2;
        $id_of_pair_3 = $request->id_of_pair_3;
        $id_of_pair_4 = $request->id_of_pair_4;

        $annotation_of_pair_0 = $request->annotation_of_pair_0;
        $annotation_of_pair_1 = $request->annotation_of_pair_1;
        $annotation_of_pair_2 = $request->annotation_of_pair_2;
        $annotation_of_pair_3 = $request->annotation_of_pair_3;
        $annotation_of_pair_4 = $request->annotation_of_pair_4;

        $user_id = Auth::user()->id;

        AnnotationsController::createAnnotation($user_id, $id_of_pair_0, $annotation_of_pair_0);
        AnnotationsController::createAnnotation($user_id, $id_of_pair_1, $annotation_of_pair_1);
        AnnotationsController::createAnnotation($user_id, $id_of_pair_2, $annotation_of_pair_2);
        AnnotationsController::createAnnotation($user_id, $id_of_pair_3, $annotation_of_pair_3);
        AnnotationsController::createAnnotation($user_id, $id_of_pair_4, $annotation_of_pair_4);

        return redirect()->back();
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
