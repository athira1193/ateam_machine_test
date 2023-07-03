@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Invited Member List</div>
                    <div class="card-body">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Event Name</th>
                                <th>Candidate Mail</th>
                                <th>Status</th>
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
                ajax: "{{ url('event-mebers') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'eventname', name: 'eventname'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection


