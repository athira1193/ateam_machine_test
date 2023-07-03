@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Events</div>
                <div class="card-body">
    <a class="btn btn-info" href="{{ route('events.create') }}" id="createNewPost"> Add New Event</a>
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Event Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Venue</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: "{{ route('events.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'eventname', name: 'eventname'},
                {data: 'start_date', name: 'start_date'},
                {data: 'end_date', name: 'end_date'},
                {data: 'venue', name: 'venue'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection


