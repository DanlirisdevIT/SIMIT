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

                <div class="modal-body">
                    <form id="upload" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label name="manufactureName" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="manufactureName" name="manufactureName" placeholder="Masukkan nama manufaktur..."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="url" class="col-sm-4 control-label"> Url </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan url..."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="supportEmail" class="col-sm-4 control-label"> Email </label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="supportEmail" name="supportEmail" placeholder="Masukkan email.."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="supportPhone" class="col-sm-4 control-label"> Phone </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="supportPhone" name="supportPhone" placeholder="Masukkan no telp..."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label name="Image" class="col-sm-4 control-label"> Pilih Gambar </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control-file" id="Image" name="Image">
                        </div>
                        <br>
                        <img src="https://via.placeholder.com/150" id="upload-img" width="100" height="100">
                    </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                <button type="button" class="btn btn-primary create">Simpan</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="updateManufacture" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Asset</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="updateManufactureForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <ul id="updateForm_errList"></ul>
                        <input type="hidden" id="id">
                        <div class="form-group">
                            <label name="manufactureName" class="col-sm-4 control-label"> Nama </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="manufactureName" name="manufactureName" placeholder="Masukkan nama manufaktur..." value = "'.$manufactures->manufactureName.'"  maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label name="url" class="col-sm-4 control-label"> Url </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Masukkan url..." value = "'.$manufactures->url.'" maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label name="supportEmail" class="col-sm-4 control-label"> Email </label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="supportEmail" name="supportEmail" placeholder="Masukkan email.." value = "'.$manufactures->supportEmail.'" maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label name="supportPhone" class="col-sm-4 control-label"> Phone </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="supportPhone" name="supportPhone" placeholder="Masukkan no telp..." value = "'.$manufactures->supportPhone.'" maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                        <label name="Image" class="col-sm-4 control-label"> Pilih Gambar </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control-file" id="update-Image" name="Image" >
                        </div>
                        <br>
                        <div id="upload-update-img"></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                        <button type="button" class="btn btn-primary update">Perbaharui</button>
                        <button type="button" class="btn btn-danger deleteManufacture"><i class="far fa-trash-alt"></i></button>
                    </div>
                </form>
            </div>
            </div>
        </div>

    {{-- <div class="modal fade" id="deleteManufacture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div> --}}

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
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });

             //create/post/store
            $(document).ready(function () {
                $(".reset").click( function(){
                    $('#manufactureName').val("");
                    $('#url').val("");
                    $('#supportEmail').val("");
                    $('#supprtPhone').val("");
                    $('#Image').val('');
                    $('#upload-img').attr('src', "https://via.placeholder.com/150"); // replace preview image with default image
                });

                $(document).on('click', '.create', function (e) {
                e.preventDefault();
                let formData = new FormData($('#upload')[0]);
                console.log(formData);

                $.ajax({
                    type: "POST",
                    url: "{{ route('manufacture.store') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status == 400){
                            $('#saveForm_errList').html("");
                            $('#saveForm_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveForm_errList').append('<li>'+err_values+'</li>');
                            });
                        }else if(response.status == 200)
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

                //show preview image
                function readImage(input){
                    if(input.files && input.files[0]){
                        var reader = new FileReader();

                        reader.onload = function (e){
                            $('#upload-img').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $('#Image').change(function () {
                    readImage(this);
                });

        });

            //edit/update
        $(document).on('click', '.editManufacture', function (e){

            e.preventDefault();

            var id = $(this).data('id');

            $('#updateManufacture').modal('show');

            $.ajax({
                type: "GET",
                url: "{{ route('manufacture.index') }}" + '/' + id + '/edit',
                success: function(response){
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editManufacture').modal('hide');
                    }
                    else
                    {
                        $('#btnDelete').html(response.html)
                        $(".reset-update").click( function(){
                            $('#updateManufactureForm').find('#manufactureName').val("");
                            $('#updateManufactureForm').find('#url').val("");
                            $('#updateManufactureForm').find('#supportEmail').val("");
                            $('#updateManufactureForm').find('#supportPhone').val("");
                            $('#updateManufactureForm').find('#Image').val("");
                        });
                        $("#id").val(id);
                        $('#updateManufacture').find("#manufactureName").val(response.manufactures.manufactureName);
                        $('#updateManufacture').find("#url").val(response.manufactures.url);
                        $('#updateManufacture').find("#supportEmail").val(response.manufactures.supportEmail);
                        $('#updateManufacture').find("#supportPhone").val(response.manufactures.supportPhone);
                        $('#updateManufacture').find("#upload-update-img").html('<img src="/uploads/Image/'+response.manufactures.Image+'" class="img-fluid" style="max-width:100px;margin-bottom:10px;">');
                        var image_name = response.manufactures.Image;
                        $('#updateManufacture').find('input[type="file"]').val('');
                    }
                }
            })

            $('input[type="file"][name="Image"]').on('change', function() {
                var img_path = $(this)[0].value;
                var img_holder = $('#upload-update-img');
                var currentImagePath = $(this).data('value');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
                if(extension == 'jpg' || extension == 'jpeg' || extension == 'png'){
                    if(typeof(FileReader) != 'undefined'){
                        img_holder.empty();
                        var reader = new FileReader();
                        reader.onload = function(e){
                            $('<img/>', {'src':e.target.result, 'class':'img-fluid', 'style':'max-width:100px;margin-bottom:10px;'}).appendTo(img_holder);
                        }
                        img_holder.show();
                        reader.readAsDataURL($(this)[0].files[0]);
                    }else{
                        $(img_holder).html('this browser not supporting file reader');
                    }
                }else{
                    $(img_holder).html(currentImagePath);
                }
            });
        });

        $(document).on('click', '.update', function(e) {
            e.preventDefault();

            $(this).text('Memperbaharui...');

            var id = $('#id').val();
            console.log(id)

            let formData = new FormData($('#updateManufactureForm')[0]);
            console.log(formData)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/manufacture/" + id,
                method: 'POST',
                data:
                formData,
                dataType: "json",
                contentType: false,
                processData: false,
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
                        $('#updateManufacture').find('input').val('');
                        $('.update').text('update');
                        $('#updateManufacture').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        })

                $(document).on('click', '.deleteManufacture', function () {
                    id = $(this).attr('id');
                    // manufactureName = $(this).attr('name');
                    // url = $(this).attr('url');
                    // supportEmail = $(this).attr('email');
                    // supportPhone = $(this).attr('phone');
                    // console.log(id)
                    // $('#deleteManufacture').modal('show');
                    // $('#id').val(id);

                    // show = "<h5> Nama Manufaktur: <b>" + manufactureName + "</b> <br></br> Url : <b>" +url+ "</b> <br></br> Support Email : <b>" +supportEmail+ "</b> <br></br> Support Phone : <b>" +supportPhone+ "</b><h5>" ;

                    // $('.show-data').html(show);

                    var id = $('#id').val();
                    console.log(id)

                    show = '<div class="col-md-12">';
                    show = show+'<div class="card mb-3 box-shadow"><div class="card-body"><h5>';
                    show = show+'Ingin menghapus data ini?';
                    show = show+'<button style="float: right; font-weight: 900;" type="button" class="btn btn-danger delete">Hapus Data?</button>';
                    show = show+'</h5></div></div></div>';

                    var $this = $('.deleteConfirm').html(show);

                    var clickCount = ($this.data("click-count")|| 0) + 1;

                    var odd = clickCount % 2;

                    $this.data("click-count", odd);

                    if (odd == 0) {
                        $this.hide();
                    }
                    else {
                        $this.show();
                    }

                    $('.delete').click(function () {
                        $.ajax({
                            url: "manufacture/" + id,
                            type: "DELETE",
                            dataType: "json",
                            success:function (response) {
                                if(response.status == 400){
                                    $('#updateForm_errList').html("");
                                    $('#updateForm_errList').addClass('alert alert-danger');
                                    // $.each(response.messages, function (key, err_value) {
                                    $('#updateForm_errList').append('<li>'+response.messages+'</li>');
                                    // });
                                    // $('.update').text('update');
                                }else{
                                    $('#updateManufacture').modal('hide');
                                    var table = $('.datatables').DataTable();
                                    table.ajax.reload();
                                    location.reload();
                                }
                            }
                        })
                    })
                });

        });
    </script>

@endsection
