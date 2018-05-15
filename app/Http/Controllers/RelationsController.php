<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public static function getAllRelations() {
        $relations = Relation::all();
        return $relations;
    }

    public static function getRelationById($id) {
        $relation = Relation::find($id);
        return $relation;
    }
}
