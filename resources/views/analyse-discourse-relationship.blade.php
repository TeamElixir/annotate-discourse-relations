@extends('layouts.master')

@section('title')
    Analyse Discourse Relationship
@stop

@section('content')
    <h5 xmlns="http://www.w3.org/1999/html">Discourse Relationship Guide</h5>
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

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="targetSent">Sentence 1:</label>
                <textarea type="text" class="form-control" rows="5" id="targetSent" name="targetSent"
                          required></textarea>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="sourceSent">Sentence 2:</label>
                <textarea class="form-control" rows="5" id="sourceSent" name="sourceSent" required></textarea>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col col-md-6 col-centered text-center btn-block">
            <button class="btn btn-info" id="btn_submit">Submit</button>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-md-3 col-lg-3 offset-md-4 offset-lg-4 text-centered">
            <div class="card" style="width: 18rem;">
                <div class="card-header">
                    Results
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" id="result_source_sentence"></li>
                    <li class="list-group-item" id="result_target_sentence"></li>
                    <li class="list-group-item" id="result_relationship"></li>
                </ul>
            </div>
        </div>
    </div>

    <br>
    <br>
@stop

@section('scripts')
    <script type="text/javascript">
        $('#btn_submit').button().click(() => {
            console.log('Clicked');
            let source_sentence = $('#sourceSent').val();
            let target_sentence = $('#targetSent').val();
            let data = {'source-sent': source_sentence, 'target-sent': target_sentence};

            const space = "&nbsp;";
            console.log(data);

            $.ajax({
                method: 'POST',
                url: 'ajax-check-relationship',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "source_sentence": source_sentence,
                    "target_sentence": target_sentence
                },
                success: function (res) {
                    console.log(res);

                    if (source_sentence.length > 0 && target_sentence.length > 0) {

                        $('#result_source_sentence').text('').append("<b>Source Sentence:</b> ", source_sentence);
                        $('#result_target_sentence').text('').append("<b>Target Sentence:</b> ", target_sentence);
                        $('#result_relationship').text('').append("<b>Relationship:</b> ", res);
                    } else {
                        $('#result_relationship').append(error_message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    $('#result_relationship').append("Error");
                }
            });
            $('#sourceSent').val('');
            $('#targetSent').val('');
        }); // end of callback function
    </script>
@stop