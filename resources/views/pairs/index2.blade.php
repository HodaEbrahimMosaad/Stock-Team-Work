@extends('layouts.app')

@section('content')
    <table class="table table-bordered" id="pairs-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Owner Name</th>
                <th>From</th>
                <th>To</th>
                <th>Duration</th>
                <th>Exchange Rate</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@endsection
@section('js')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer ></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script>
        $(document).ready(function(){
            $('#pairs-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("pairs") }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'owner', name: 'owner' },
                    { data: 'from_id', name: 'from_id' },
                    { data: 'to_id', name: 'to_id' },
                    { data: 'duration', name: 'duration' },
                    { data: 'exchange_rate', name: 'exchange_rate' },
                ]
            });
        });
    </script>
@endsection