@extends('layouts.app')

@section('styling')
    <style>
        #form_model {
            margin-bottom: 20px;
        }

        table#view_table td {
            border: none !important;
        }

        table#view_table th {
            border: none !important;
        }

        .user_view_cl {
            padding: 8px 10px;
            border-radius: 3px;
        }

        td#button_id {
            display: flex;
            justify-content: center;
        }

        .same_style {
            margin-left: 5px;
        }
    </style>
@endsection

@section('content')
    @include('users.form')
    @include('users.detail')
    @include('users.delete')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="button_div text-center">
                            <button type="button" class="btn btn-info btn-center" data-toggle="modal"
                                    data-target="#formModal" id="form_model">+ Add New User
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table id="default_order" class="table table-striped table-bordered display no-wrap"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>SID Number</th>
                                    <th>Mobile Number</th>
                                    <th>Email Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                @foreach($users as $user)
                                    <tbody>
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->surname}}</td>
                                        <td>{{$user->south_african_id}}</td>
                                        <td>{{$user->mobile_number}}</td>
                                        <td>{{$user->email}}</td>
                                        <td id="button_id">
                                            <button type="button"
                                                    class="btn-primary same_style fas fa-eye user_view_cl"
                                                    user-id="{{$user->id}}"></button>
                                            <button type="button"
                                                    class="btn btn-info same_style fas fa-edit user_edit_cl"
                                                    user-id="{{$user->id}}"></button>
                                            <button type="button"
                                                    class="btn btn-danger same_style delete_user_cl fas fa-trash-alt"
                                                    data-toggle="modal" data-target="#delete-modal"
                                                    user-id="{{$user->id}}"></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function saveUser() {
            const data = $("#user_form").serialize();
            const url = '{{url('/user/save')}}';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'post',
                data: data,
                success: function (response) {
                    $('#user_form')[0].reset();
                    toastr.success(response.message);

                    myInterval = setInterval(function () {
                        location.reload();
                        clearInterval(myInterval);
                    }, 2000);
                },
                error :function( data ) {
                    $.each(data.responseJSON.errors, function (key, message) {
                        $("#"+ key +"_error").html(message);
                    });
                }
            });
        }

        //Get Data for Update
        $(document).on('click', '.user_edit_cl', function (e) {
            e.preventDefault(e);
            const user_id = $(this).attr("user-id");

            $.ajax({
                url: '/user/get',
                method: 'get',
                data: {user_id: user_id},
                success: function (response) {
                    $('#user_id_ed').val(response.user.id);
                    $('#user_id').val(response.user.id);
                    $('#name').val(response.user.name);
                    $('#email').val(response.user.email);
                    $('#surname').val(response.user.surname);
                    $('#south_african_id').val(response.user.south_african_id);
                    $('#lang').val(response.user.language);
                    $('#dob').val(response.user.dob);
                    $('#mobile_number').val(response.user.mobile_number);
                    $("input[data-role=tagsinput]").tagsinput('add', response.interests);

                    $('#formModal').modal('show');
                }
            });
        });
        //End Update

        //Get Data for Detail View
        $(document).on('click', '.user_view_cl', function (e) {
            e.preventDefault(e);
            const user_id = $(this).attr("user-id");

            $.ajax({
                url: '/user/get',
                method: 'get',
                data: {user_id: user_id},
                success: function (response) {
                    var html='<tr><th>Name:</th><td>'+response.user.name+'</td></tr>' +
                        '<tr><th>Surname:</th><td>'+response.user.surname+'</td></tr>' +
                        '<tr><th>South African Id:</th><td>'+response.user.south_african_id+'</td></tr>'+
                        '<tr><th>Mobile Number:</th><td>'+response.user.mobile_number+'</td></tr>'+
                        '<tr><th>Email:</th><td>'+response.user.email +'</td></tr>'+
                        '<tr><th>Date Of Birth:</th><td>'+response.user.dob +'</td></tr>'+
                        '<tr><th>Language:</th><td>'+response.user.language +'</td></tr>'+
                        '<tr><th>Interest:</th><td>'+response.interests +'</td></tr>';
                    $('#view_table').html(html);
                    $('#myViewModal').modal('show');
                }
            });
        });
        //End detail function

        //Delete function
        $(document).on('click', '.delete_user_cl', function (e) {
            e.preventDefault(e);
            const user_id = $(this).attr("user-id");

            $('#delete_user_id').val(user_id);
            $('#delete-modal').modal('show');
        });

        $(document).on('click', '#delete_user_rec', function (e) {
            e.preventDefault(e);
            const delete_user_id = $('#delete_user_id').val();

            $.ajax({
                url: "/user/delete",
                type: "get",
                data: {user_id: delete_user_id},
                success: function (response) {
                    console.log(response);
                    if (response.status == 200) {
                        toastr.success(response.message);
                        $('#delete-modal').modal('hide');
                        myInterval = setInterval(function () {
                            location.reload();
                            clearInterval(myInterval);
                        }, 2000);
                    }
                }
            });
        });
        //end delete process
    </script>
@endsection
