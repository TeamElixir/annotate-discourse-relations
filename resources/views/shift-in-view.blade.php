@extends('layouts.master')

@section('title')
    Shift-in-View Sentence Pairs
@stop

@section('content')
    <div class="row">
        <h4>Shift-in-View Pairs</h4>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">SentencePairID</th>
                    <th scope="col">Source Sentencce</th>
                    <th scope="col">Target Sentence</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allPairs as $pair)
                    @if($pair->relation == 5)
                    <tr>
                        <td>{{$pair->id}}</td>
                        <td>{{$pair->sentencePair->SourceSentence->sentence}}</td>
                        <td>{{$pair->sentencePair->TargetSentence->sentence}}</td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop