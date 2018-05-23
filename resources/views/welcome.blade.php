@extends('layouts.master')

@section('title')
    Home
@stop

@section('content')
    <div class="row">
        <h3>FYP OBLIE</h3>
    </div>
    <form action="{{route('not-defined')}}" method="post">
        {{csrf_field()}}
        @php
            $i = 0;
        @endphp
        {{--Loop through all sentence pairs--}}
        @foreach($sentence_pairs as $sentence_pair)
            <div class="row">
                <div data-aos="fade-left"
                     data-aos-duration="700"
                     class="col-md-8 col-centered">
                    <h5>Pair {{$sentence_pair->pair_id}}</h5>
                    <ul class="list-group">
                        {{--Sentencer 1--}}
                        <li class="list-group-item">
                            <div><strong>Sentence 1</strong>: {{$sentence_pair->SourceSentence->sentence}}</div>
                        </li>

                        {{--Sentence 2--}}
                        <li class="list-group-item">
                            <div><strong>Sentence 2</strong>: {{$sentence_pair->TargetSentence->sentence}}</div>
                        </li>

                        {{--Relation--}}
                        <li class="list-group-item">
                            <strong>Relation between the two
                                sentences</strong>: {{$sentence_pair->OriginalRelation->simpleRelation->relation}}
                        </li>
                        <br>

                        {{--Dropdown selector--}}
                        <div class="row">
                            <div class="col-md-6 col-centered text-center">
                                <div id="dropdown_block_{{$sentence_pair->pair_id}}">
                                    <select class="custom-select" id="dropdown_{{$sentence_pair->pair_id}}"
                                            name="annotation_of_pair_{{$i}}">
                                        <option disabled selected value> -- select an option --</option>
                                        <option value="0">{{$sentence_pair->SimpleRelation->relation}} is Correct!
                                        </option>
                                        @foreach($simple_relations as $simple_relation)
                                            {{--Skip the relation that's mentioned in the questioned--}}
                                            @if(!($simple_relation->id == $sentence_pair->SimpleRelation->id))
                                                <option value="{{$simple_relation->id}}">No,
                                                    it's {{$simple_relation->relation}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            <hr>

            <input type="hidden" value="{{$sentence_pair->pair_id}}" name="id_of_pair_{{$i}}">
            @php
                $i++;
            @endphp
        @endforeach

        <div class="row">
            <div class="col-md-8 col-centered">
                <input type="submit" class="btn btn-info" value="Submit">
            </div>
        </div>
    </form>

    <br>
    <br>
    <br>
@stop
