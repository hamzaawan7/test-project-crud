@extends('layouts.layout')
@section('content')
<head>
    <style>
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
</head>

    <!-- sample modal content -->
    <div id="myViewModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                   <table class="table" id="view_table">

                   </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->




    <!-- Add User Modal -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">User Modal</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mt-2 mb-4">
                        <a href="index.html" class="text-success">
                            <span><img class="mr-2" src="../assets/images/logo-icon.png" alt="" height="18"><img
                                    src="../assets/images/logo-text.png" alt="" height="18"></span>
                        </a>
                    </div>

                    <form class="pl-3 pr-3" action="#" id="user_form">
                        <input type="text" id="user_id" name="user_id">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="user_id" id="user_id_ed">
                            <div class="form-group col-md-6">
                                <label for="username">Name</label>
                                <input class="form-control" type="text" id="name"
                                       required="" name="name" placeholder="Michael Zenaty">
                                <span class="text-danger" id="name_error"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="surname">Surname</label>
                                <input class="form-control" type="text" id="surname"
                                       required="" name="surname" placeholder="Enter Surname">
                                <span class="text-danger" id="surname_error"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="id">South African Id Number</label>
                                <input class="form-control" type="number" required=""
                                       id="south_african_id" name="south_african_id"
                                       placeholder="Enter South African Id Number">
                                <span class="text-danger" id="sid_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Mobile Number</label>
                                <input class="form-control" type="text" required=""
                                       id="mobile_number" name="mobile_number" placeholder="Enter your mobile no">
                                <span class="text-danger" id="cnumber_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input class="form-control" type="email" required=""
                                       id="email" name="email" placeholder="Enter your email">
                                <span class="text-danger" id="email_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dob">Birth Date</label>
                                <input class="form-control" type="date" required=""
                                       id="dob" name="dob">
                                <span class="text-danger" id="dob_error"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="language">Select Language</label>
                                <select class="form-control" aria-label="Default select example" name="language"
                                        id="lang">
                                    <option selected>Select Language</option>
                                    <option value="English">English</option>
                                    <option value="Spanish">Spanish</option>
                                    <option value="Arabic">Arabic</option>
                                    <option value="Mandarin">Mandarin</option>
                                </select>
                                <span class="text-danger" id="language_error"></span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="interest">Interests </label>
                                <input class="form-control" type="text" data-role="tagsinput" name="interests"
                                       id="interests" placeholder="Enter your interest" required>
                                <span class="text-danger" id="interest_error"></span>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="addUser()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-top">
            <div class="modal-content">
                <input type="hidden" id="delete_user_id">
                <div class="modal-header">
                    <h4 class="modal-title" id="topModalLabel">Do You Want To Delete?</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-dismiss="modal">Cancle
                    </button>
                    <button type="button" class="btn btn-primary" id="delete_user_rec">yes Delete</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.End Delete user modal -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="button_div text-center">
                            <button type="button" class="btn btn-info btn-center" data-toggle="modal"
                                    data-target="#addModal" id="add_user_model">+ Add New User
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table id="default_order" class="table table-striped table-bordered display no-wrap"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>SurName</th>
                                    <th>Id Number</th>
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
                                            <button type="button" class="btn-primary  fas fa-eye user_view_cl"
                                                    user-id="{{$user->id}}"></button>
                                            <button type="button" class="btn btn-info same_style fas fa-edit user_edit_cl"
                                                    user-id="{{$user->id}}" ></button>
                                            <button type="button"
                                                    class="btn btn-danger same_style delete_user_cl  fas fa-trash-alt"
                                                    data-toggle="modal" data-target="#delete-modal"
                                                    user-id="{{$user->id}}" ></button>
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
