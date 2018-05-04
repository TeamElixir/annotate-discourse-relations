@extends('layouts.master')

@section('title')
    Home
@stop

@section('content')
    <div class="row">
        <h3>FYP OBLIE</h3>
    </div>

    @foreach($sentence_pairs as $sentence_pair)
        <div class="row">
            <div class="col-md-8 col-centered">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div><strong>Source Sentence</strong>: {{$sentence_pair["source_sntc"]->sentence}}</div>
                    </li>
                    <li class="list-group-item">
                        <div><strong>Target Sentence</strong>: {{$sentence_pair["target_sntc"]->sentence}}</div>
                    </li>
                    <li class="list-group-item"><strong>Relation</strong>: {{$sentence_pair["relation_1"]}}</li>
                </ul>

                <br>
                <div >
                    <button class="btn btn-primary">True</button>
                    <button class="btn btn-primary">False</button>
                </div>
                <hr>
            </div>
        </div>
        <br>
    @endforeach
@stop
