
<footer class="footer text-center fixed-bottom text-muted">
    All Rights Reserved by Adminmart. Designed and Developed by <a
        href="https://wrappixel.com">WrapPixel</a>.
</footer>
</div>
</div>

<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous"></script>

<!-- apps -->
<!-- apps -->
<script src="{{asset('dist/js/app-style-switcher.js')}}"></script>
<script src="{{asset('dist/js/feather.min.js')}}"></script>
<script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
<script src="{{asset('libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboards/dashboard1.min.js')}}"></script>
<script src="{{asset('assets/extra-libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>


<script>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();

    /****************************************
     *       Default Order Table           *
     ****************************************/
    $('#default_order').DataTable({
        "order": [
            [3, "desc"]
        ]
    });

    /****************************************
     *       Multi-column Order Table      *
     ****************************************/
    $('#multi_col_order').DataTable({
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }]
    });
</script>
<script>

    function addUser() {
        // alert('heelow');
        var data = $("#user_form").serialize();
        var url = '{{url('/user/save')}}';
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
                if (response.status == 400) {
                    $.each(response.error, function (key, err_values) {
                        if (key == 'name') {
                            $("#name_error").html(err_values);
                        }
                        if (key == 'surname') {
                            $("#surname_error").html(err_values);
                        }
                        if (key == 'south_african_id') {
                            $("#sid_error").html(err_values);
                        }
                        if (key == 'mobile_number') {
                            $("#cnumber_error").html(err_values);
                        }
                        if (key == 'email') {
                            $("#email_error").html(err_values);
                        }
                        if (key == 'dob') {
                            $("#dob_error").html(err_values);
                        }
                        if (key == 'language') {
                            $("#language_error").html(err_values);
                        }
                        if (key == 'interest') {
                            $("#interest_error").html(err_values);
                        }
                    });
                } else {
                    if (response.status == 401) {
                        toastr.warning(response.message);
                    } else if (response.status == 402) {
                        toastr.warning(response.message);
                    } else {
                        $('#user_form')[0].reset();
                        toastr.success(response.message);
                        myInterval = setInterval(function () {
                            location.reload();
                            clearInterval(myInterval);
                        }, 2000);

                    }
                }
            }
        });
    }

    //Get Data for Update

    $(document).on('click', '.user_edit_cl', function (e) {
        e.preventDefault(e);
        var user_id = $(this).attr("user-id");
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

                $('#addModal').modal('show');
            }
        });


    });

    //End Update

    //Get Data for Detail View

    $(document).on('click', '.user_view_cl', function (e) {
        e.preventDefault(e);
        var user_id = $(this).attr("user-id");
        $.ajax({
            url: '/user/detail',
            method: 'get',
            data: {user_id: user_id},
            success: function (response) {
                console.log(response.user);
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
        var user_id = $(this).attr("user-id");
        //alert(employee_id);
        $('#delete_user_id').val(user_id);
        $('#delete-modal').modal('show');

    });

    $(document).on('click', '#delete_user_rec', function (e) {

        e.preventDefault(e);
        var delete_user_id = $('#delete_user_id').val();

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
