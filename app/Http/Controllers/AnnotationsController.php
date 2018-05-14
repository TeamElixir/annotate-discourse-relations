<?php

namespace App\Http\Controllers;

use App\Annotation;
use Illuminate\Http\Request;

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

    }
}
