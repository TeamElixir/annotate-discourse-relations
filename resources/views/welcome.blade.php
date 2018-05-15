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
            <div data-aos="fade-left"
                 data-aos-duration="700"
                 class="col-md-8 col-centered">
                <h5>Pair {{$sentence_pair["pair_id"]}}</h5>
                <ul
                        class="list-group">
                    <li class="list-group-item">
                        <div><strong>Source Sentence</strong>: {{$sentence_pair["source_sntc"]->sentence}}</div>
                    </li>
                    <li class="list-group-item">
                        <div><strong>Target Sentence</strong>: {{$sentence_pair["target_sntc"]->sentence}}</div>
                    </li>
                    <li class="list-group-item">
                        <strong>Relation</strong>: {{$sentence_pair["relation_1"]}}
                    </li>
                    <br>
                    <div class="row">
                        <div class="col-md-8 col-centered text-center">
                            @if($sentence_pair["user_already_annotated"])
                                <div>
                                    <div id="btn_submitted_{{$sentence_pair["pair_id"]}}"
                                         class="btn btn-outline-info disabled">
                                        Submitted
                                    </div>
                                </div>
                            @else
                                <div id="true-false_{{$sentence_pair["pair_id"]}}">
                                    <button id="btn_true_{{$sentence_pair["pair_id"]}}"
                                            onclick="markTrue({{$sentence_pair["pair_id"]}})"
                                            class="btn btn-primary">True
                                    </button>
                                    <button id="btn_false_{{$sentence_pair["pair_id"]}}"
                                            onclick="markFalse({{$sentence_pair["pair_id"]}})"
                                            class="btn btn-warning">False
                                    </button>
                                </div>
                                <div>
                                    <input type="hidden" id="user_id" name="user_id" value="{{$auth_user->id}}">
                                    <input type="hidden" id="pair_id" name="pair_id"
                                           value="{{$sentence_pair["pair_id"]}}">
                                    <input type="hidden" id="annotation" name="annotation" value="1">
                                    <button style="display: none;"
                                            onclick="annotate({{$sentence_pair["pair_id"]}})"
                                            class="btn btn-dark text-center col-centered"
                                            id="btn_submit_{{$sentence_pair["pair_id"]}}">
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
@stop

@section('scripts')
    <script type="text/javascript">
        function markTrue(pair_id) {
            console.log("markTrue()");
            annotation = 0;

            hide_elements(pair_id);
        }

        function hide_elements(pair_id) {
            // hide 'true-false' div
            $('#true-false_' + pair_id).fadeOut('fast');

            // show submit button
            $('#btn_submit_' + pair_id).css('display', 'block');
        }

        function markFalse(pair_id) {
            console.log("markFalse()");
            annotation = 2;

            hide_elements(pair_id);
        }

        var user_id = $('#user_id').val();

        function annotate(pair_id) {
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
                    $('#btn_submit_' + pair_id).fadeOut("fast");
                    $('#btn_submitted_' + pair_id).fadeIn('fast');
                },
                error: function (xhr, status, error) {
                    console.log(status, " ", error);
                }
            });
        }

        var annotation = -1;

        $('#btn_true').button().click(function () {
            annotation = 1;
        });

        $('#btn_false').button().click(function () {
            annotation = 2;
        });
    </script>
@stop
