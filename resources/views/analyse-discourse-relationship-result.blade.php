@extends('layouts.master')

@section('title')
    Analyse Discourse Relationship
@stop

@section('content')
    {{--<h5>Discourse Relationship Guide</h5>--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8">--}}
        {{--@foreach($simple_relations as $simple_relation)--}}
            {{--<div class="card" style="width: 14rem;">--}}
                {{--<div class="card-body">--}}
                    {{--<h5 class="card-title">{{$simple_relation->relation}}</h5>--}}
                    {{--<p>{{$simple_relation->description}}</p>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endforeach--}}
        {{--</div>--}}
        {{--<p>For examples, please see <a target="_blank" href="http://bit.ly/2LtVir4">this</a></p>--}}
    {{--</div>--}}
    <br>

    <div class="row">
        <div class="col-md-12 col-centered">
            <ul class="list-group">
                <li class="list-group-item"><b>Source Sentence</b>: {{$sourceSent}}</li>
                <li class="list-group-item">Target Sentence: {{$targetSent}}</li>
                <li class="list-group-item">Relationship: {{$mapping}}</li>
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 col-centered">
            <a class="btn btn-primary" href="{{route('analyse-relationship')}}">Back</a>
        </div>
    </div>
@stop