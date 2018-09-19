<?php

namespace App\Http\Controllers;

use App\PairUserAnnotation;
use Illuminate\Http\Request;

class ShiftInViewsController extends Controller
{
    public function index()
    {
        $allPairs = PairUserAnnotation::all();
        $noOfShiftInViewPairs = 0;
        foreach ($allPairs as $pair) {
            if ($pair->relation == 5) {
                $noOfShiftInViewPairs++;
            }
        }
        return view('shift-in-view', [
            'allPairs' => $allPairs,
            'noOfShiftInViewPairs' => $noOfShiftInViewPairs
        ]);
    }
}
