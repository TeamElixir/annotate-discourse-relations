<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'relation', 'description', 'text_span_1', 'text_span_2'];

    public function simpleRelation() {
        return $this->belongsTo(SimpleRelation::class);
    }
}
