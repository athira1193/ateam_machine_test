@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 style="text-align: center;"> {{ __('You are logged in!') }}</h1><br>
                        <h5>Number of Events : {{$event_count}}</h5><br>
                        <h5>Number of Invited Members : {{$members_invite}}</h5><br>
                        <h5>Number of Rejected Members : {{$members_reject}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
