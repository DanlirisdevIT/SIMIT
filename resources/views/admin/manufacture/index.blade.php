@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">List Manufaktur</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addManufacture">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Url</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addManufacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Manufaktur</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="saveForm_errList"></ul>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="manufactureName" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="manufactureName" name="manufactureName" placeholder="Masukkan nama manufaktur..."  maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="modal-body1">
                    <div class="form-group">
                        <label name="url" class="col-sm-4 control-label"> url </label>
                        <div class="col-sm-12">
                            <input type="url" class="form-control" id="url" name="url" placeholder="Masukkan url..."  maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="modal-body1">
                    <div class="form-group">
                        <label name="supportEmail" class="col-sm-4 control-label"> Email </label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="supportEmail" name="supportEmail" placeholder="Masukkan email..."  maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="modal-body1">
                    <div class="form-group">
                        <label name="supportPhone" class="col-sm-4 control-label"> Phone </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="supportPhone" name="supportPhone" placeholder="Masukkan no telp..."  maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="modal-body1">
                    <div class="form-group">
                        <label name="image" class="col-sm-4 control-label"> Image </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="image" name="image"   maxlength="50" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                <button type="button" class="btn btn-primary create">Simpan</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="updateManufacture tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Manufaktur</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="updateForm_errList"></ul>
                <form id="ManufactureForm" name="ManufactureForm" class="form-horizontal">
                    <input type="hidden" id="id">
                    <div class="EditManufactureBody">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                <button type="button" class="btn btn-primary update">Perbaharui</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="deleteManufacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <div class="show-data">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete">Hapus Data?</button>
            </div>
          </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.datatables').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ route('manufacture.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'manufactureName', name: 'manufactureName'},
                    {data: 'url', name: 'url'},
                    {data: 'supportEmail', name: 'supportEmail'},
                    {data: 'supportPhone', name: 'supportPhone'},
                    {data: 'image', name: 'image'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });

        $(document).ready(function () {
            $(".reset").click( function(){
                $('#manufactureName').val("");
                $('#url').val("");
                $('#supportEmail').val("");
                $('#supportPhone').val("");
                $('#image').val("");
            });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'manufactureName': $('#manufactureName').val(),
                    'url': $('#url').val(),
                    'supportEmail': $('#supportEmail').val(),
                    'supportPhone': $('#supportPhone').val(),
                    'image': $('#image').val(),
                }

                $(this).removeData();

                $.ajax({
                    type: "POST",
                    url: "{{ route('manufacture.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response){
                        if(response.status == 400)
                        {
                            $('#saveForm_errList').html("");
                            $('#saveForm_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveForm_errList').append('<li>'+err_values+'</li>');
                            });
                        }
                        else if(response.status == 200)
                        {
                            $('#saveForm_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.messages);
                            $('#addManufacture').modal('hide');
                            $('#addManufacture').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                        }
                    }
                });
            });
        });

        $(document).on('click', '.editManufacture', function (e) {
                    e.preventDefault();

                    var id = $(this).data('id');

                    $('#updateManufacture').modal('show');

                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('manufacture.index') }}" + '/' + id + '/edit',
                        success: function (response) {
                            if (response.status == 404) {
                                $('#updateForm_errList').addClass('alert alert-success');
                                $('#updateForm_errList').text(response.message);
                                $('.editManufacture').modal('hide');
                            }
                            else
                            {
                                $('.EditManufactureBody').html(response.html)
                                $(".reset-update").click( function(){
                                    $('.EditManufactureBody').find('#manufactureName').val("");
                                    $('.EditManufactureBody').find('#url').val("");
                                    $('.EditManufactureBody').find('#supportEmail').val("");
                                    $('.EditManufactureBody').find('#supportPhone').val("");
                                    $('.EditManufactureBody').find('#image').val("");
                                });
                                $("#manufactureName").html(response.manufactures['manufactureName']);
                                $("#url").html(response.manufactures['url']);
                                $("#supportEmail").html(response.manufactures['supportEmail']);
                                $("#supportPhone").html(response.manufactures['supportPhone']);
                                $("#image").html(response.manufactures['image']);
                                console.log(response.manufactures['manufactureName'])
                                console.log(response.manufactures['url'])
                                console.log(response.manufactures['supportEmail'])
                                console.log(response.manufactures['supportPhone'])
                                console.log(response.manufactures['image'])
                                $("#id").val(id);
                            }
                        }
                    });
                });

        $(document).on('click', '.update', function (e) {
            e.preventDefault();

            $(this).text("Memperbaharui...");

            var id = $('#id').val();

            console.log(id)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/manufacture/" + id,
                method: 'PUT',
                data: $('#ManufactureForm').serialize(),
                dataType: "json",
                success: function(response){
                    if(response.status == 400)
                    {
                        $('#updateForm_errList').html("");
                        $('#updateForm_errList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_value) {
                            $('#updateForm_errList').append('<li>'+err_value+'</li>');
                        });
                        $('.update').text('update');
                    }
                    else
                    {
                        $('#updateForm_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.messages);
                        $('#updateManufacture').find("input").val('');
                        $('.update').text('update');
                        $('#updateManufacture').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        });

        $(document).on('click', '.deleteManufacture', function () {
            id = $(this).attr('id');
            manufactureName = $(this).attr('name');
            url = $(this).attr('url');
            supportEmail = $(this).attr('email');
            supportPhone = $(this).attr('phone');
            image = $(this).attr('image');
            console.log(id)
            $('#deleteManufacture').modal('show');
            $('#id').val(id);

            show = "<h5> Nama Manufaktur : <b>" + manufactureName + "</b><h5>";
            show = "<h5> url : <b>" + url + "</b><h5>";
            show = "<h5> Email : <b>" + supportEmail + "</b><h5>";
            show = "<h5> Phone : <b>" + supportPhone + "</b><h5>";
            show = "<h5> Image : <b>" + image + "</b><h5>";

            $('.show-data').html(show);

            $('.delete').click(function () {
                $.ajax({
                    url: "manufacture/" + id,
                    type: "DELETE",
                    dataType: "json",
                    success:function (response) {
                        $('#deleteManufacture').modal('hide');
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                    }
                })
            })
        });

    });

    </script>

@endsection

