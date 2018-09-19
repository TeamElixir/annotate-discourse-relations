<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PairUserAnnotation extends Model
{
    public static $table_name = "pair_user_annotations";

    public function simpleRelation()
    {
        $relations = ["No Relation", "Elaboration", "Redundancy", "Citation", "Shift in View"];
        return $relations[$this->relation];
    }

    public function sentencePair() {
        return $this->hasOne(SentencePair::class, "id", "pair_id");
    }
}
