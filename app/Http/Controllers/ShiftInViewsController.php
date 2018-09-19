<?php

namespace App\Http\Controllers;

use App\PairUserAnnotation;
use Illuminate\Http\Request;
use DB;

class ShiftInViewsController extends Controller
{
    public function index()
    {
        $allPairs = PairUserAnnotation::all();
        return view('shift-in-view', ['allPairs' => $allPairs]);
    }
}
