@extends('layouts.app')

@section('content')
    <table class="table table-bordered" id="pairs-table">
        <thead>
        <tr>
            <th>Id</th>

        </tr>
        </thead>
    </table>
@stop
@section('js')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTable.bootstrap.min.js') }}"></script>
    <script>
        $('#pairs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('pairs') !!}',
            columns: [
                { data: 'id', name: 'id' },

            ]
        });
    </script>
    @endsection