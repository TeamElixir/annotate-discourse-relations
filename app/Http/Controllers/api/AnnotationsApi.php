<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Annotation;

class AnnotationsApi extends Controller
{
    public static function getAllAnnotations() {
        $all_annotations = Annotation::all();
        return response()->json($all_annotations);
    }

    public static function getAnnotationsOfuser($user_id) {
        $annotations = Annotation::where('user_id', '=', $user_id)->get();
        return response()->json($annotations);
    }
}
