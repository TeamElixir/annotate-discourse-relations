@extends('layouts.master')

@section('title')
    Home
@stop

@section('content')
    <div class="row">
        <h3>FYP OBLIE</h3>
    </div>
    <div class="row col-md-8 col-centered">
        {{ $sentence_pairs->links() }}
    </div>

    @foreach($sentence_pairs as $sentence_pair)
        <div class="row">
            <div data-aos="fade-left"
                 data-aos-duration="700"
                 class="col-md-8 col-centered">
                <h5>Pair {{$sentence_pair->id}}</h5>
                <ul
                        class="list-group">
                    <li class="list-group-item">
                        <div><strong>Sentence 1</strong>: {{$sentence_pair->SourceSentence->sentence}}</div>
                    </li>
                    <li class="list-group-item">
                        <div><strong>Sentence 2</strong>: {{$sentence_pair->TargetSentence->sentence}}</div>
                    </li>
                    <li class="list-group-item">
                        <strong>Relation</strong>: {{$sentence_pair->OriginalRelation->simpleRelation->relation}}
                    </li>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-centered text-center">
                            @if($sentence_pair->UserAlreadyAnnotated)
                                <div>
                                    <h6 id="btn_submitted_{{$sentence_pair->id}}"></h6>
                                </div>
                            @else
                                <div id="dropdown_block_{{$sentence_pair->id}}">
                                    <select class="custom-select" id="dropdown_{{$sentence_pair->id}}">
                                        <option value="0" selected><strong>{{$sentence_pair->SimpleRelation->relation}}</strong> is Correct!</option>
                                        @foreach($relations as $relation)
                                            @if(!($relation->id == $sentence_pair->relation))
                                                <option value="{{$relation->id}}">{{$relation->relation}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <br>
                                    <br>
                                    <button id="btn_submit_{{$sentence_pair->id}}"
                                            onclick="annotate({{$sentence_pair->id}})"
                                            class="btn btn-primary">Submit
                                    </button>
                                </div>
                                <div>
                                    <input type="hidden" id="user_id" name="user_id" value="{{$auth_user->id}}">
                                    <input type="hidden" id="pair_id" name="pair_id"
                                           value="{{$sentence_pair->id}}">
                                    <input type="hidden" id="annotation" name="annotation" value="1">
                                    <button style="display: none;"
                                            onclick="annotate({{$sentence_pair->id}})"
                                            class="btn btn-dark text-center col-centered"
                                            id="btn_submit_{{$sentence_pair->id}}">
                                        Submit
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        <hr>
    @endforeach
    <div class="row col-md-8 col-centered">
        {{ $sentence_pairs->links() }}
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        function hide_elements(pair_id) {
            // hide 'true-false' div
            $('#true-false_' + pair_id).fadeOut('fast');

            // show submit button
            $('#btn_submit_' + pair_id).css('display', 'block');
        }

        var user_id = $('#user_id').val();

        function annotate(pair_id) {
            var annotation = $('#dropdown_' + pair_id).val();
            console.log('annotation: ', annotation);
            $.ajax({
                url: 'annotations/create',
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'user_id': user_id,
                    'pair_id': pair_id,
                    'annotation': annotation
                },
                headers: {},
                success: function (res) {
                    console.log(res);
                    $('#dropdown_block_' + pair_id).fadeOut("fast");
                    $('#btn_submitted_' + pair_id).append('Submitted');
                },
                error: function (xhr, status, error) {
                    console.log(status, " ", error);
                }
            });
        }
    </script>
@stop
