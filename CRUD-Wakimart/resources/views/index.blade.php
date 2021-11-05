@extends('layout.app')
@section('content')
<div class="alert alert-primary text-center" role="alert">
    <h2>CRUD User Management</h2>
</div>

<div class="container">

    <div class="result"></div>

    <a class="btn btn-primary addData mb-3"><i class="fas fa-plus"> Add Data</i></a>
    <div id="data"></div>

    <!-- Modal -->
    <div class="modal fade" id="modalAddData" tabindex="-1" aria-labelledby="addDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="addDataLabel">Add Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add_name">Name</label>
                        <input type="email" class="form-control" id="add_name" name="add_name" placeholder="Your Name">
                        <small id="error_name" class="form-text text-gray"></small>
                    </div>

                    <div class="form-group">
                        <label for="add_email">Email address</label>
                        <input type="email" class="form-control" id="add_email" name="add_email" placeholder="Your Email">
                        <small id="error_email" class="form-text text-gray"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary BtnAddCancel" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary BtnAddData" idEdit="">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editDataLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <input type="email" class="form-control" id="edit_name" name="edit_name">
                        <small id="error_edit_name" class="form-text text-gray"></small>
                    </div>

                    <div class="form-group">
                        <label for="edit_email">Email address</label>
                        <input type="email" class="form-control" id="edit_email" name="edit_email">
                        <small id="error_edit_email" class="form-text text-gray"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary BtnEditCancel" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary BtnEditData" idEdit="">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            getDataUser();

            function resetModal() {
                $("#modalAddData").modal("hide");
                $("#modalAddData").find("input").val("");
            }

            function resetModalEdit() {
                $("#modalEditData").modal("hide");
                $("#modalEditData").find("input").val("");
            }

            function _csrf() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
            }

            // ADD DATA
            $(".addData").on("click", function (e) {
                e.preventDefault();
                $("#modalAddData").modal("show");
                $(".BtnAddData").on("click", function () {
                    let data = {
                        name: $("#add_name").val(),
                        email: $("#add_email").val(),
                    };
                    _csrf();
                    $.ajax({
                        method: "POST",
                        url: '{{ url("/") }}',
                        data: data,
                        beforeSend: function () {
                            let btn = $(".BtnAddData");
                            $(".BtnAddCancel").hide();
                            btn.attr("disabled", true);
                            btn.html("Please Wait...");
                        },
                        success: function (response) {
                            if (response.status == 201) {
                                if (response.errors.name) {
                                    $("#error_name").html(response.errors.name);
                                } else {
                                    $("#error_name").html("");
                                }
                                if (response.errors.email) {
                                    $("#error_email").html(response.errors.email);
                                } else {
                                    $("#error_email").html("");
                                }
                            } else {
                                resetModal();
                                $(".result").html(response.message);
                                getDataUser();
                            }
                        },
                        complete: function (data) {
                            $(".BtnAddCancel").show();
                            $(".BtnAddData").attr("disabled", false);
                            $(".BtnAddData").html("Save changes");
                        },
                    });
                });
            });

            $("#data").on('click', '.showData', function(){
                const id = $(this).attr("data-id");
                $.ajax({
                    url : "{{url('/show')}}/" + id,
                    method : "GET",
                    success : function(data){
                        // console.log(data);
                        $("#modalAddData").modal('show');
                        $("#add_name").val(data.name);
                        $("#add_email").val(data.email);
                        $('#addDataLabel').html('Data User ' + data.name);
                        $(".BtnAddData").hide();
                        $('.BtnAddCancel').html('Exit');
                        
                    }
                });
            });

            $("#data").on('click', '.editData', function(){
                let id = $(this).attr("data-id");
                $.ajax({
                    url : "{{url('/edit')}}/" + id,
                    method : "GET",
                    success : function(data){
                        console.log(data);
                        $("#modalEditData").modal('show');
                        $("#edit_name").val(data.name);
                        $("#edit_email").val(data.email);
                        $(".BtnEditData").attr("idEdit", data.id);
                        $(".BtnEditData").on('click', function(e){
                            let myData = {
                                'id' : $(this).attr("idEdit"),
                                'name': $("#edit_name").val(),
                                'email': $("#edit_email").val(),
                            }
                            _csrf();
                            $.ajax({
                                method : "POST",
                                url : "{{url('/update')}}",
                                data : myData,
                                beforeSend: function () {
                                    let btn = $("#BtnEditData");
                                    $('.BtnEditCancel').hide();
                                    btn.attr("disabled", true);
                                    btn.html("Please Wait...");
                                },
                                success : function(response){
                                    
                                    if(response.status == 201){
                                        if (response.errors.name) {
                                            $('#error_edit_name').html(response.errors.name);
                                        } else {
                                            $('#error_edit_name').html("");
                                        }
                                        
                                        if (response.errors.email) {
                                            $('#error_edit_email').html(response.errors.email);
                                        } else {
                                            $('#error_edit_email').html("");
                                        }
                                        } else {
                                            resetModalEdit();
                                            $('.result').html(response.message);
                                            getDataUser();
                                        }
                                    },
                                complete:function(data){
                                    $('.BtnEditCancel').show();
                                    $("#BtnEditData").attr("disabled", false);
                                    $("#BtnEditData").html("Save changes");
                                }
                            });
                        }); 
                    }
                });
            });

            // DELETE DATA
            $("#data").on('click', '.deleteData', function(){
                confirm('Are you sure to delete data');
                let id = $(this).attr("data-id");
                
                if(true){
                    _csrf();
                    $.ajax({
                    method : "delete",
                    url : "{{url('/delete')}}/" + id,
                    data : "name=" + name,
                    success : function(data){
                        if(data.status == 200){
                            $('.result').html(data.message);
                            getDataUser();
                        } else {
                            $('.result').html(data.message);
                            getDataUser();
                        }
                        
                    }
                });
                }
            });

            function getDataUser() {
                $.ajax({
                    method: "GET",
                    url: "{{ url('/getData') }}",
                    success: function (data) {
                        // console.log(data);
                        $("#data").html(data);
                    },
                });
            }
        });

    </script>
@endsection