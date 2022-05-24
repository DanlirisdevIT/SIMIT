@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Barang</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addAsset">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Manufaktur</th>
                                        <th>Nama Kategori</th>
                                        <th>Nomor Model</th>
                                        <th>EOL</th>
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

    <div class="modal fade" id="addAsset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <ul id="saveForm_errList"></ul>
                        <form id="upload" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label name="asset_name" class="col-sm-4 control-label"> Nama </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="asset_name" name="asset_name" placeholder="Masukkan nama Asset..."  maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label name="manufacture_id" class="col-sm-4 control-label"> Pilih Manufaktur </label>
                                <select class="form-control select2" id="manufacture_id" name="manufacture_id" style="width: 100%;">
                                    @foreach ($manufactures as $manufacture)
                                        @if ($manufacture->deletedBy == '')
                                            <option value={{ $manufacture->id }}>{{$manufacture->manufactureName}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                                <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                                    @foreach ($categories as $category)
                                        @if ($category->deletedBy == '')
                                            <option value={{ $category->id }}>{{$category->category_type}} - {{$category->category_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label name="model_number" class="col-sm-4 control-label"> Nomor Model </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="model_number" name="model_number" placeholder="Nomor model..."  maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label name="EOL" class="col-sm-4 control-label"> EOL </label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="EOL" name="EOL" placeholder="EOL..." maxlength="50" required>
                                </div>
                            </div>
                            {{-- <div class="form-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01"> Pilih Gambar </label>
                                </div>
                                <div class="form-group-prepend">
                                    <img src="https://via.placeholder.com/150" id="upload-img" width="100" height="100">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label name="notes" class="col-sm-4 control-label"> Keterangan </label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="notes" name="notes" placeholder="Masukkan keterangan..."  maxlength="50" required></textarea>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label name="images" class="col-sm-4 control-label"> Pilih Gambar </label>
                                <div class="col-sm-12">
                                    <input type="file" class="form-control-file" id="images" name="images">
                                </div>
                                <br>
                                <img src="https://via.placeholder.com/150" id="upload-img" width="100" height="100">
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                    <button type="button" class="btn btn-primary create">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateAsset" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Asset</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="updateAssetForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <ul id="updateForm_errList"></ul>
                    <input type="hidden" id="id">
                    {{-- <div class="EditAssetBody">

                    </div> --}}
                    <div class="form-group">
                        <label name="asset_name" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="asset_name" name="asset_name" placeholder="Masukkan nama Asset..."  maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label name="manufacture_id" class="col-sm-4 control-label"> Pilih Manufaktur </label>
                        <select class="form-control select2" id="manufacture_id" name="manufacture_id" style="width: 100%;">
                            {{-- <option value="0" disabled="true" selected="true"> Pilih </option> --}}
                            @foreach ($manufactures as $manufacture)
                                @if ($manufacture->deletedBy == '')
                                    <option value={{ $manufacture->id }}>{{$manufacture->manufactureName}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                        <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                            @foreach ($categories as $category)
                                @if ($category->deletedBy == '')
                                    <option value={{ $category->id }}>{{$category->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label name="model_number" class="col-sm-4 control-label"> Nomor Model </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="model_number" name="model_number" placeholder="Nomor model..."  maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label name="EOL" class="col-sm-4 control-label"> EOL </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="EOL" name="EOL" placeholder="EOL..." maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label name="notes" class="col-sm-4 control-label"> Keterangan </label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="notes" name="notes" placeholder="Masukkan keterangan..."  maxlength="50" required></textarea>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label name="images" class="col-sm-4 control-label"> Pilih Gambar </label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control-file" id="update-images" name="images" >
                        </div>
                        <br>
                        <div id="upload-update-img"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                    <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                    <button type="button" class="btn btn-primary update">Perbaharui</button>
                    <button type="button" class="btn btn-danger deleteAsset"><i class="far fa-trash-alt"></i></button>
                </div>
            </form>
          </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="deleteAsset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                ajax: "{{ route('asset.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'asset_name', name: 'asset_name', width: '15%'},
                    {data: 'manufactures.manufactureName', name: 'manufactures.manufactureName', width: '15%'},
                    {data: 'categories.category_name', name: 'categories.category_name', width: '15%'},
                    {data: 'model_number', name: 'model_number', width: '15%'},
                    {data: 'EOL', name: 'EOL', width: '15%'},
                    {data: 'action', name: 'action', width: '5%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        });

        $('#manufacture_id').select2({
            theme: 'bootstrap4'
        })

        $('#category_id').select2({
            theme: 'bootstrap4'
        })

        $('#updateAsset').find('#manufacture_id').select2({
            theme: 'bootstrap4'
        })

        $('#updateAsset').find('#category_id').select2({
            theme: 'bootstrap4'
        })

        //create/post/store
        $(document).ready(function () {
            $(".reset").click( function(){
                $('#asset_name').val("");
                $('#model_number').val("");
                $('#EOL').val("");
                $('#images').val('');
                $('#upload-img').attr('src', "https://via.placeholder.com/150"); // replace preview image with default image
                $('#notes').val("");
            });

            //automatically clear data when pop up was suddenly closed
            // $("#addAsset").on('hidden.bs.modal', function(e){
            //     $(this).find('#upload')[0].reset();
            // });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();
                let formData = new FormData($('#upload')[0]);
                console.log(formData);

                $.ajax({
                    type: "POST",
                    url: "{{ route('asset.store') }}",
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
                            $('#addAsset').modal('hide');
                            // $('#addCompany').modal('show');
                            $('#addAsset').find("input").val("");
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
            $('#images').change(function () {
                readImage(this);
            });
        });

        //edit/update
        $(document).on('click', '.editAsset', function (e){

            e.preventDefault();

            var id = $(this).data('id');

            $('#updateAsset').modal('show');

            $.ajax({
                type: "GET",
                url: "{{ route('asset.index') }}" + '/' + id + '/edit',
                success: function(response){
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editAsset').modal('hide');
                    }
                    else
                    {
                        $('#btnDelete').html(response.html)
                        $(".reset-update").click( function(){
                            $('#updateAssetForm').find('#asset_name').val("");
                            $('#updateAssetForm').find('#manufacture_id').val("selectedIndex", 0);
                            $('#updateAssetForm').find('#category_id').val("selectedIndex", 0);
                            $('#updateAssetForm').find('#model_number').val("");
                            $('#updateAssetForm').find('#EOL').val("");
                            $('#updateAssetForm').find('#notes').val("");
                            $('#updateAssetForm').find('#images').val("");
                            // $('#updateAssetForm').find('#upload-update-img').val("https://via.placeholder.com/150");
                        });
                        // $("#asset_name").html(response.assets['asset_name']);
                        // $("#manufacture_id").html(response.manufactures['manufactureName']);
                        // $("#category_id").html(response.categories['category_name']);
                        // $("#model_number").html(response.assets['model_number']);
                        // $("#EOL").html(response.assets['EOL']);
                        // $("#update-images").html(response.assets['images']);
                        // $("#upload-update-img").attr('src', '/uploads/images/'+response.assets['images']);
                        // $('#notes').html(response.assets['notes']);
                        // console.log(response.assets['images']);
                        $("#id").val(id);
                        $('#updateAsset').find("#asset_name").val(response.assets.asset_name);
                        var option_manufaktur = '<option value = "'+response.manufactures.id+'" selected> --- '+response.manufactures.manufactureName+' --- </option>'
                        $('#updateAsset').find('select[name="manufacture_id"]').append(option_manufaktur);
                        var option_category = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                        $('#updateAsset').find('select[name="category_id"]').append(option_category);
                        // $('#updateAsset').find("#category_id").val(response.categories.category_name);
                        $('#updateAsset').find("#model_number").val(response.assets.model_number);
                        $('#updateAsset').find("#EOL").val(response.assets.EOL);
                        $('#updateAsset').find("#notes").val(response.assets.notes);
                        $('#updateAsset').find("#upload-update-img").html('<img src="/uploads/images/'+response.assets.images+'" class="img-fluid" style="max-width:100px;margin-bottom:10px;">');
                        // $('#updateAsset').find('input[name="images"]').find('input[type="file"]').attr('data-value', '<img src="/uploads/images/'+response.assets.images+'" class="img-fluid" style="max-width:100px;margin-bottom:10px;">');
                        var image_name = response.assets.images;
                        // $('#updateAsset').find('#update-images').find('input[type="file"]').attr(image_name);
                        $('#updateAsset').find('input[type="file"]').val('');
                    }
                }
            })

            $('input[type="file"][name="images"]').on('change', function() {
                var img_path = $(this)[0].value;
                var img_holder = $('#upload-update-img');
                var currentImagePath = $(this).data('value');
                var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
                if(extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'webp'){
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

            let formData = new FormData($('#updateAssetForm')[0]);
            // let formData = new FormData(document.getElementById($('#AssetForm'));
            // var formData = {
            //     asset_name: $('.EditAssetBody').find('#asset_name').val(),
            //     manufacture_id: $('.EditAssetBody').find('#manufacture_id').val(),
            //     category_id: $('.EditAssetBody').find('#category_id').val(),
            //     EOL: $('.EditAssetBody').find('#EOL').val(),
            //     model_number: $('.EditAssetBody').find('#model_number').val(),
            //     images: $(this).find('#update_images').val(),
            //     notes: $('.EditAssetBody').find('#notes').val(),
            // };
            console.log(formData)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/asset/" + id,
                method: 'POST',
                data: formData,
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
                        $('#updateAsset').find('input').val('');
                        $('.update').text('update');
                        $('#updateAsset').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload(); //untuk auto refresh halaman
                    }
                }
            })
        })

        // $(function(){
        //         if (Cookies.get('deleteConfirm') == 'true' && Cookies.get('deleteConfirm') != 'undefined' ){
        //     $(".deleteConfirm").hide();
        //     }
        //     else
        //     {
        //         $(".deleteConfirm").show();
        //     }

        //     $('.deleteAsset').click(function () {
        //          Cookies.set('deleteConfirm', 'true');
        //             $(".deleteConfirm").hide();
        //     });
        // });

        $(document).on('click', '.deleteAsset', function () {

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
                    url: "asset/" + id,
                    type: "DELETE",
                    dataType: "json",
                    success:function (response) {
                        if(response.status == 400  || response.status == 404){
                            $('#updateForm_errList').html("");
                            $('#updateForm_errList').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_value) {
                                $('#updateForm_errList').append('<li>'+err_value+'</li>');
                            });
                        }
                        else
                        {
                            $('.update').text('update');
                            $('#updateAsset').modal('hide');
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                            location.reload();
                            // clickCount.reset();
                        }
                    }
                })
            })
        });

    </script>
@endsection
