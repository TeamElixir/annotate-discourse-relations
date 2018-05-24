@extends('layouts.master')

@section('title')
    Home
@stop

@section('content')
    <h5>Annotation Guide</h5>
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
    <form action="{{route('not-defined')}}" method="post" onsubmit="return validateForm()" name="annotationForm">
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
                            <div><strong>Sentence 1</strong>: {{$sentence_pair->TargetSentence->sentence}}</div>
                        </li>

                        {{--Sentence 2--}}
                        <li class="list-group-item">
                            <div><strong>Sentence 2</strong>: {{$sentence_pair->SourceSentence->sentence}}</div>
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
                                <div id="dropdown_block_{{$i}}">
                                    <select class="custom-select required" id="dropdown_{{$i}}"
                                            name="annotation_of_pair_{{$i}}">
                                        <option disabled selected value> -- select an option --</option>
                                        <option value="0">{{$sentence_pair->SimpleRelation->relation}} is Correct!
                                        </option>
                                        @foreach($simple_relations as $simple_relation)
                                            {{--Skip the relation that's mentioned in the question--}}
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

@section('scripts')
    <script type="text/javascript">
        function validateForm() {
            var valid = true;
            var i;
            var annotations = [];
            for (i = 0; i < 5; i++) {
                annotations[i] = document.forms["annotationForm"]["dropdown_" + i].value;

                if (annotations[i] == "") {
                    valid = false;
                }
            }


            if (valid) {
                return confirm("Are you sure you want to Submit the answers?");
            } else {
                alert("Please select an option for each question");
                return false;
            }
        }
    </script>
@stop
