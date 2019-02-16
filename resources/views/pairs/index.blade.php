@php $title='Pairs'; @endphp
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dataTable.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fix_datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
@endsection
@section('content')
    <div class="col-md-10 test" style="margin: 20px auto; height: -webkit-fill-available" id="freshItems">
        <a class="addPair" href="{{ route('pairs.create') }}" target="_blank">
            <button class="btn btn-primary">
                <i class="fa fa-plus">
                    Add Pair
                </i>
            </button>
        </a>
        <a class="syncPairs" href="{{ route('pairs.sync') }}" target="_blank">
            <button class="btn btn-primary">
                <i class="fa fa-plus">
                    Sync All
                </i>
            </button>
        </a>
        <br><br>
        {!! get_session('suc') !!}
        <h4 style="height: 10px;" class="e1 text-center">Active Pair</h4>
        <span class="daimond"></span>
        <br>
        <table id="myTable" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <th>ID</th>
                <th>Owner Name</th>
                <th>From</th>
                <th>To</th>
                <th>Duration</th>
                <th>Exchange Rate</th>
                <th>Actions</th>
            </thead>
            <tbody>
            @foreach( $pairs as $pair)
                <tr>
                    <td>
                        <a target="_blank" href="{{ route('pairs.show', $pair->id) }}" >
                            {{ $pair->id }}
                        </a>
                    </td>
                    <td>{{ $pair->owner->name }}</td>
                    <td>{{ $pair->from->currency_name }}</td>
                    <td>{{ $pair->to->currency_name }}</td>
                    <td>{{ $pair->duration }}</td>
                    <td>{{ $pair->exchange_rate }}</td>
                    <td>
                        <a target="_blank" class="btn btn-primary edit btn-sm" href="{{ route('pairs.edit', $pair->id) }}">
                            <i class="fa fa-edit">
                                edit
                            </i>
                        </a>
                        <a data-toggle="modal" data-target="#exampleModal" class="btn btn-danger delete btn-sm" data-id="{{ $pair->id }}">
                            <i class="fa fa-trash">
                                delete
                            </i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @if( count($trashed_pairs) > 0 )
        <hr>
        <div>
            <h4  class="e1 text-center">Disabled Pair</h4>
            <span class="daimond"></span>
            <table style="" class="table table-bordered table-hover">
                <thead class="thead-dark">
                <th>ID</th>
                <th>Owner Name</th>
                <th>From</th>
                <th>To</th>
                <th>Duration</th>
                <th>Exchange Rate</th>
                <th>Actions</th>
                </thead>
                <tbody>
                @foreach( $trashed_pairs as $trashed_pair)
                    <tr>
                        <td>
                            {{ $trashed_pair->id }}
                        </td>
                        <td>{{ $trashed_pair->owner->name }}</td>
                        <td>{{ $trashed_pair->from->currency_name }}</td>
                        <td>{{ $trashed_pair->to->currency_name }}</td>
                        <td>{{ $trashed_pair->duration }}</td>
                        <td>{{ $trashed_pair->exchange_rate }}</td>
                        <td>
                            <a class="btn btn-success delete btn-sm" data-id="{{ $trashed_pair->id }}" id="restore" >
                                <i class="fa fa-trash">
                                    Restore
                                </i>
                            </a>
                            <a class="btn btn-danger delete btn-sm" data-id="{{ $trashed_pair->id }}" id="force_delete" >
                                <i class="fa fa-trash">
                                    Permanently Delete
                                </i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    Delete Pair?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/jquery.js') }}"></script>
    {{--    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('js/dataTable.bootstrap.min.js') }}"></script>--}}
    <script src="{{ asset('js/pair_delete_script.js') }}"></script>
    <script>
        // $('#myTable').DataTable();
    </script>

@endsection

