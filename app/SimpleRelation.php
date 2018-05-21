<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleRelation extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'relation'];

    public function originalRelations() {
        return $this->hasMany(Relation::class);
    }
}
