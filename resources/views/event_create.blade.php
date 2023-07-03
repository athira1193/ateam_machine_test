@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Event') }}</div>

                    <div class="card-body">
                        <form id="eventForm" name="eventForm" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Event Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="event_name" name="event_name" placeholder="Event Name" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Start Date</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" name="start_date" id="start_date" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">End Date</label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" name="end_date" id="end_date" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Venue</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="venue" id="venue" value="" placeholder="Enter Venue" />
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="savedata" value="create">Save Event
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
        $('#savedata').click(function (e) {
            e.preventDefault();
            var base_url = {!! json_encode(url('/')) !!};
            $.ajax({
                data: $('#eventForm').serialize(),
                url: "{{ route('events.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    alert("New Event created Successfully")
                    window.location.href = base_url+"/"+"events";
                }
            });
        });
        });
    </script>
@endsection

