@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_style.css') }}">
    <style>
        hr:last-of-type
        {
            display: none;
        }
        hr {  border-top: 1px solid white;}
    </style>
@endsection
@section('content')

    <div class="profile">
        <h4 class="text-center">Pair</h4>
        <span class="daimond"></span>
        <div class="row">
            <div class="col">
                Owner name:
            </div>
            <div class="col right">
                {{ $pair->owner->name }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                From:
            </div>
            <div class="col right">
                {{ $pair->from->currency_name }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                to :
            </div>
            <div class="col right">
                {{ $pair->to->currency_name }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                Exchange Rate
            </div>
            <div class="col right">
                {{ number_format((float)$pair->exchange_rate, 2) }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                Duration:
            </div>
            <div class="col right">
                {{ $pair->duration }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                Created At:
            </div>
            <div class="col right">
                {{ $pair->created_at->diffForHumans() }}
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                Updated At:
            </div>
            <div class="col right">
                {{ $pair->updated_at->diffForHumans() }}
            </div>
        </div>
        @if( count($pair->triggers) > 0 )

        <div class="profile" style="
            width: 60%;
            background: rgba(0, 0, 0, .4);
           color: white;">
            <h4 class="text-center">Triggers</h4>
            <span class="daimond"></span>
            @foreach( $pair->triggers as $trigger)
            <div class="row">
                <div class="col">
                   Event Type:
                </div>
                <div class="col right">
                    {{ $trigger->event->event_type_name }}
                </div>
            </div>
                <div class="row">
                    <div class="col">
                        Created At:
                    </div>
                    <div class="col right">
                        {{ $trigger->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Updated At:
                    </div>
                    <div class="col right">
                        {{ $trigger->created_at->diffForHumans() }}
                    </div>
                </div>
                <hr>
            @endforeach
        </div>

            @endif
    </div>

@endsection
@section('js')

@endsection
