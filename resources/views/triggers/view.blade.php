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




            <div class="profile" style="
            width: 60%;
            background: rgba(0, 0, 0, .4);
           color: white;">
                {!! get_session('suc') !!}
                <h4 class="text-center">Triggers</h4>
                <span class="daimond"></span>
                <div class="row">
                    <div class="col">
                        User Name:
                    </div>
                    <div class="col right">
                        {{ $trigger->owner->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Belongs To:
                    </div>
                    <div class="col right">
                        <a  target="_blank" href="{{ route('pairs.show',$trigger->pair->id) }}">
                            Pair
                        </a>

                    </div>
                </div>
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
                            Level:
                        </div>
                        <div class="col right">
                            {{ $trigger->level}}
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
                <button data-toggle="modal" data-target="#exampleModal" class="btn btn-dark submit">
                    <i class="fa fa-submit">
                        Edit
                    </i>
                </button>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Trigger</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <br>

                        </div>

                        <div class="modal-body" style="padding: 0px;">
                            <form id="sub" style="width: 100%;margin: 0px;border-radius: 0px" action="{{ route('triggers.update',$trigger->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <div class="row" style="height: 57px;">
                                    <div class="col">
                                        {{--<input type="text" class="form-control" placeholder="Name" name="name">--}}
                                        <select name="event_type_id" class="form-control">
                                            <option selected disabled>
                                                Event Type:
                                            </option>
                                            @foreach( $events as $event)
                                                <option @if($event->id==$trigger->event_type_id) selected @endif  value="{{ $event->id }}">
                                                    {{ $event->event_type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ( $errors->has('event_type_id'))
                                            <span style="display: block;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('event_type_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <input value="{{ $trigger->level }}"  required type="text" class="form-control" placeholder="Level" name="level">
                                        @if ( $errors->has('level'))
                                            <span style="display: block;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('level') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" @if (!($errors->has('event_type_id')&& $errors->has('level'))) onclick="$('#sub').submit()" @endif class="btn btn-dark">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>


@endsection
@section('js')
@endsection