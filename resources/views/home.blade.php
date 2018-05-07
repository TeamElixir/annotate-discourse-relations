@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <strong>Logged in as:</strong> {{$user->name}} ({{$user->email}})
                        </div>
                        <br>
                        <div>
                            <a href="{{url('/')}}" class="btn btn-primary">Proceed to annotation</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
