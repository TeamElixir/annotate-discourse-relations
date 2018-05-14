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
                    <li data-aos="fade-left"
                        data-aos-duration="600"
                        data-aos-delay="50"
                        class="list-group-item">
                        <div><strong>Source Sentence</strong>: {{$sentence_pair["source_sntc"]->sentence}}</div>
                    </li>
                    <li data-aos="fade-left"
                        data-aos-duration="600"
                        data-aos-delay="100"
                        class="list-group-item">
                        <div><strong>Target Sentence</strong>: {{$sentence_pair["target_sntc"]->sentence}}</div>
                    </li>
                    <li data-aos="fade-left"
                        data-aos-duration="600"
                        data-aos-delay="150"
                        class="list-group-item">
                        <strong>Relation</strong>: {{$sentence_pair["relation_1"]}}
                    </li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <div data-aos="fade-left"
                 data-aos-duration="600"
                 data-aos-delay="150"
                 class="col-md-8 col-centered text-center">
                <button id="btn-true" class="btn btn-primary">True</button>
                <button id="btn-false" class="btn btn-warning">False</button>
            </div>
        </div>
        <br>
        <hr>
    @endforeach
@stop
