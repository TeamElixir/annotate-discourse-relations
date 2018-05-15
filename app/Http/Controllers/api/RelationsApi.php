<?php

namespace App\Http\Controllers\api;

use App\Relation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RelationsApi extends Controller
{
    public function getAllRelations() {
        $relations = Relation::all();
        return response()->json($relations);
    }

    public function getRelationById($id) {
        $relation = Relation::find($id);
        return response()->json($relation);
    }
}
