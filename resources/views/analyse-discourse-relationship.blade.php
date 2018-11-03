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

    <form class="" action="{{route('submit-sentences')}}" method="post">
        {{csrf_field()}}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="targetSent">Sentence 1:</label>
                    <textarea class="form-control" rows="5" name="targetSent" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sourceSent">Sentence 2:</label>
                    <textarea class="form-control" rows="5" name="sourceSent" required></textarea>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12 col-centered">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </div>
    </form>
@stop