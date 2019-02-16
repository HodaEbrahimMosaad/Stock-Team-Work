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
        <div  id="freshItems">
        @if( count($pair->triggers) > 0 )

            <div class="profile" style="
            width: 80%;
            background: rgba(0, 0, 0, .4);
           color: white;">
            {!! get_session('suc') !!}
            <h4 class="text-center">Triggers</h4>
            <span class="daimond"></span>
            @foreach( $pair->triggers as $trigger)
            <div class="row" >
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
                        {{ $trigger->level }}
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
            <br>
            <a target="_blank" href="{{ route('triggers.show',$trigger->id) }}">
                More Details
            </a>
                <a style="float: right;" data-toggle="modal" data-target="#exampleModalDel" class="btn btn-danger delete btn-sm" data-id="{{ $trigger->id }}">
                    <i class="fa fa-trash">
                        delete
                    </i>
                </a>
                <hr>
            @endforeach
        </div>
            <div class="modal fade" id="exampleModalDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <br>

                        </div>

                        <div class="modal-body">
                            Delete Trigger?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="delete">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        @if( count($trashed_triggers) > 0 )

                <div class="profile" style="
            width: 80%;
            background: rgba(0, 0, 0, .4);
           color: white;">
                    <h4 class="text-center">Disables Triggers</h4>
                    <span class="daimond"></span>
                    @foreach( $trashed_triggers as $trashed_trigger)
                        <div class="row" >
                            <div class="col">
                                Event Type:
                            </div>
                            <div class="col right">
                                {{ $trashed_trigger->event->event_type_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Level:
                            </div>
                            <div class="col right">
                                {{ $trashed_trigger->level }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                Created At:
                            </div>
                            <div class="col right">
                                {{ $trashed_trigger->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <br>

                        <a data-toggle="modal" class="btn btn-success delete btn-sm" data-id="{{ $trashed_trigger->id }}" id="restore">
                            <i class="fa fa-trash">
                                Restore
                            </i>
                        </a>
                        <a style="float: right;"  class="btn btn-danger delete btn-sm" data-id="{{ $trashed_trigger->id }}" id="force_delete">
                            <i class="fa fa-trash">
                                Froce delete
                            </i>
                        </a>
                        <hr>
                    @endforeach
                </div>

        @endif
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Trigger</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <br>

                    </div>

                    <div class="modal-body" style="padding: 0px;">
                        <form id="sub" style="width: 100%;margin: 0px;border-radius: 0px" action="{{url('triggers/store/'.$pair->id)}}" method="post">
                            @csrf
                            <div class="row" style="height: 57px;">
                                <div class="col">
                                    {{--<input type="text" class="form-control" placeholder="Name" name="name">--}}
                                    <select name="event_type_id" class="form-control">
                                        <option selected disabled>
                                            Event Type:
                                        </option>
                                        @foreach( $events as $event)
                                            <option  value="{{ $event->id }}">
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
                                    <input required type="text" class="form-control" placeholder="Level" name="level">
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
        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-dark submit" type="submit">
            <i class="fa fa-submit">
                Add Trigger
            </i>
        </button>
    </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/trigger_delete_script.js') }}"></script>
@endsection
