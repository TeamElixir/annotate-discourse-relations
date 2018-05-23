<?php

namespace App;

use App\Http\Controllers\AnnotationsController;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class SentencePair extends Model
{
    public static $table_name = "annotated_sentence_pairs";
    protected $table = "annotated_sentence_pairs";
    protected $attributes = [
        'AuthUserId' => '',
        'SourceSentence' => '',
        'TargetSentence' => '',
        'OriginalRelation' => '',
        'SimpleRelation' => '',
        'UserAlreadyAnnotated' => ''
    ];

    public function annotations()
    {
        return $this->hasMany(Annotation::class);
    }

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


    public function getUserAlreadyAnnotatedAttribute()
    {
        $auth_users_annotations = AnnotationsController::getAnnotationsOfuser(Auth::user()->id);
        $user_already_annotated = false;
        foreach ($auth_users_annotations as $annotation) {
            if ($annotation->pair_id == $this->id) {
                $user_already_annotated = true;
            }
        }

        return $user_already_annotated;
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
