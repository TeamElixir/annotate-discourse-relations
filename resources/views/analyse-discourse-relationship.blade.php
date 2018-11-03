@extends('layouts.master')

@section('title')
    Analyse Discourse Relationship
@stop

@section('content')
<h5>Discourse Relationship Guide</h5>
<div class="row">
    {{--<div class="col-md-8">--}}
    @foreach($simple_relations as $simple_relation)
        <div class="card" style="width: 14rem;">
            <div class="card-body">
                <h5 class="card-title">{{$simple_relation->relation}}</h5>
                <p>{{$simple_relation->description}}</p>
            </div>
        </div>
    @endforeach
    {{--</div>--}}
    <p>For examples, please see <a target="_blank" href="http://bit.ly/2LtVir4">this</a></p>
</div>
<br>

<form class="" action="/submit-sentences" method="post" type="multipart/form-data">
    {{method_field('PATCH')}}
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="row">
        <div class="form-group">
            <label for="comment">Sentence 1:</label>
            <textarea class="form-control" rows="5" name="source-sent" required></textarea>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="comment">Sentence 2:</label>
            <textarea class="form-control" rows="5" name="target-sent" required></textarea>
        </div>
    </div>

    <div class="col-md-12">
            <button type="submit" class="btn btn-primary pull-right" value="post">
            Submit
            </button>
    </div>
    {{csrf_field()}}
</form>
@stop