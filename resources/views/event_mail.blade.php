@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Send an Invitattion') }}</div>

                    <div class="card-body">
                        <form id="invitationForm" name="invitationForm" class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Sender Name</label>
                                <div class="col-sm-12">
                                    <input type="hidden" name="event_id" id="event_id" value="{{$events->id}}">
                                    <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="Sender Name" value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sender Email</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="sender_email" id="sender_email" value="" placeholder="Sender Email" />
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="invitedata" value="create">Send Invitation
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#invitedata').click(function (e) {
                e.preventDefault();
                var base_url = {!! json_encode(url('/')) !!};
                $.ajax({
                    data: $('#invitationForm').serialize(),
                    url: "{{ url('invitation-mail') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        alert("Invitation mailed Successfully")
                        window.location.href = base_url+"/"+"events";
                    }
                });
            });
        });
    </script>
@endsection

