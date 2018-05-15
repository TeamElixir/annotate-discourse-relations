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
                <h5>Pair {{$sentence_pair["pair_id"]}}</h5>
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
                    <br>
                    <div class="row">
                        <div data-aos="fade-left"
                             data-aos-duration="600"
                             data-aos-delay="150"
                             class="col-md-8 col-centered text-center">
                            @if($sentence_pair["user_already_annotated"])
                                <div>
                                    <button class="btn btn-info">Edit Submission</button>
                                </div>
                            @else
                                <div>
                                    <button id="btn_true" class="btn btn-primary">True</button>
                                    <button id="btn_false" class="btn btn-warning">False</button>
                                </div>
                                <div>
                                    {{csrf_field()}}
                                    <input type="hidden" id="user_id" name="user_id" value="{{$auth_user->id}}">
                                    <input type="hidden" id="pair_id" name="pair_id"
                                           value="{{$sentence_pair["pair_id"]}}">
                                    <input type="hidden" id="annotation" name="annotation" value="1">
                                    <button class="btn btn-dark" id="btn_submit">Submit</button>
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
        var user_id = $('#user_id').val();
        var pair_id = $('#pair_id').val();
        var annotation = -1;
        $('#btn_true').button().click(function () {
            annotation = 1;
        });

        $('#btn_false').button().click(function () {
            annotation = 2;
        });

        $('#btn_submit').button().click(function () {
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
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
    </script>
@stop
