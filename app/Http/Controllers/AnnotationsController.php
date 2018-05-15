<?php

namespace App\Http\Controllers;

use App\Annotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnnotationsController extends Controller
{
    public static function getAllAnnotations() {
        $all_annotations = Annotation::all();
        return $all_annotations;
    }

    public static function getAnnotationsOfuser($user_id) {
        $annotations = Annotation::where('user_id', '=', $user_id)->get();
        return $annotations;
    }

    public function createAnnotation(Request $request) {
        $user_id = $request->user_id;
        $pair_id = $request->pair_id;
        $annotation = $request->annotation;

        DB::table('annotations')->insert([
            'user_id' => $user_id,
            'pair_id' => $pair_id,
            'annotation' => $annotation
        ]);

        return "annotated";
    }
}
