<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentencePairForUser extends Model
{
//pair_id, source_sntc_id, target_sntc_id, relation, cluster_id

    public $pair_id;
    public $source_sntc_id;
    public $target_sntc_id;
    public $relation;
    public $cluster_id;

    protected $attributes = [
        'SourceSentence' => '',
        'TargetSentence' => '',
        'OriginalRelation' => '',
        'SimpleRelation' => '',
    ];

    public function getOriginalRelationAttribute()
    {
        $r = Relation::find($this->relation);
        return $r;
    }

    public function getSimpleRelationAttribute()
    {
        $r = $this->getOriginalRelationAttribute();
        return $r->simpleRelation;
    }

    public function getSourceSentenceAttribute()
    {
        $source_sentence = Sentence::find($this->source_sntc_id);
        return $source_sentence;
    }

    public function getTargetSentenceAttribute()
    {
        $target_sentence = Sentence::find($this->target_sntc_id);
        return $target_sentence;
    }

}
