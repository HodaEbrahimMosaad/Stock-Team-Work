@php $title='Dashboard'; @endphp
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dataTable.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fix_datatable.css') }}">
@endsection
@section('content')
    <div class="col-md-10 test" style="margin: 20px auto; height: -webkit-fill-available" id="freshItems">
        {!! get_session('suc') !!}
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
                        <a target="_blank" href="{{ route('pairs.show', $pair->id) }}}" >
                            {{ $pair->id }}
                        </a>
                    </td>
                    <td>{{ $pair->owner->name }}</td>
                    <td>{{ $pair->from->currency_name }}</td>
                    <td>{{ $pair->to->currency_name }}</td>
                    <td>{{ $pair->exchange_rate }}</td>
                    <td>{{ $pair->duration }}</td>
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
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <br>

                </div>

                <div class="modal-body">
                    Delete Manager ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="delete">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="addBtn" style="display: none;">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTable.bootstrap.min.js') }}"></script>
    <script>
        $('#myTable').DataTable();
    </script>
@endsection
