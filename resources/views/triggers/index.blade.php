@php $title='Pair Info'; @endphp
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile_style.css') }}">
    <style>
        hr:last-of-type{display: none;}
        hr{border-top: 1px solid white;}
    </style>
@endsection
@section('content')
    <div class="profile" style="width: 60%;background: rgba(0, 0, 0, .4);color: white;">
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
@endsection
@section('js')
@endsection
