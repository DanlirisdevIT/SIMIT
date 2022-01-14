@extends('template.layouts.app')

@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <h2 class="mb-4">Service Dalam Asset</h2>
                                <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addServiceMasukAsset">
                                    Tambah
                                </button>

                                <br><br>
                                @csrf
                                <table class="table table-bordered datatables">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kategori</th>
                                            <th>Nama Barang</th>
                                            <th>Barcode</th>
                                            <th>No Seri/IP</th>
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

        <div class="modal fade" id="addServiceMasukAsset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Service Dalam Asset</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <ul id="saveForm_errList"></ul>
    
                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="antrianservice_id" class="col-sm-4 control-label"> Pilih Nama </label>
                            <select class="form-control" id="antrianservice_id" name="antrianservice_id">
                                <option value="">Pilih  Nama----</option>
                                @foreach ($antrian_services as $antrianservice)
                                    @if($antrianservice->deletedBy == '')
                                        <option value={{ $antrianservice->id }}>{{$antrianservice->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="">Pilih  Kategori----</option>
                                @foreach ($categories as $category)
                                    @if($category->deletedBy == '')
                                        <option value={{ $category->id }}>{{$category->category_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label name="nama_barang" class="col-sm-4 control-label"> Nama Barang </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan Nama Barang..." maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="barcode" class="col-sm-4 control-label"> Barcode </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Masukkan Barcode..." maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="no_seri" class="col-sm-4 control-label"> IP/No Seri </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="no_seri" name="no_seri" placeholder="Masukkan IP/no seri..." maxlength="50">
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

        <div class="modal fade" id="updateServiceMasukAsset" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Edit Antrian Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                            <form id="updateServiceMasukAssetForm" name="updateServiceMasukAssetForm" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="modal-body" style="overflow:hidden;">
                                    <ul id="updateForm_errList"></ul>
                                    <input type="hidden" id="id">
                
                                    <div class="modal-body1">
                                        <div class="form-group">
                                            <label name="antrianservice_id" class="col-sm-4 control-label"> Pilih Nama </label>
                                            <select class="form-control" id="antrianservice_id" name="antrianservice_id">
                                                @foreach ($antrian_services as $antrianservice)
                                                    @if($antrianservice->deletedBy == '')
                                                        <option value={{ $antrianservice->id }}>{{$antrianservice->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="modal-body1">
                                        <div class="form-group">
                                            <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                                            <select class="form-control" id="category_id" name="category_id">
                                                @foreach ($categories as $category)
                                                    @if($category->deletedBy == '')
                                                        <option value={{ $category->id }}>{{$category->category_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                
                            <div class="form-group">
                                <label name="nama_barang" class="col-sm-4 control-label"> Nama Barang </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang..." maxlength="50" required>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label name="barcode" class="col-sm-4 control-label"> Barcode </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Masukkan barcode..." maxlength="50" required>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label name="no_seri" class="col-sm-4 control-label"> IP/No Seri </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="no_seri" name="no_seri" placeholder="Masukkan IP/No seri..." maxlength="50" required>
                                </div>
                            </div>
    
                                </div>
                            </form>
                            <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                                <button type="button" class="btn btn-primary update">Perbaharui</button>
                                <button type="button" class="btn btn-danger deleteServiceMasukAsset"><i class="far fa-trash-alt"></i></button>
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
                    ajax: "{{ route('servicemasukasset.index') }}",
                    method: 'GET',
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                        {data: 'antrian_services.name', name: 'antrian_services.name', width: '15%' },
                        {data: 'categories.category_name', name: 'categories.category_name', width: '15%'},
                        {data: 'nama_barang', name: 'nama_barang', width: '15%'},
                        {data: 'barcode', name: 'barcode', width: '15%'},
                        {data: 'no_seri', name: 'no_seri', width: '15%'},
                        {data: 'action', name: 'action', width: '5%'},
                    ],
                    order: [
                        [0, 'desc'],
                    ],
                });
            })

            $(document).ready(function () {
                $('.reset').click(function (){

                })

                $(document).on('click', '.create', function (e) {
                    e.preventDefault();

                    var data = {
                        'antrianservice_id': $('#antrianservice_id').val(),
                        'category_id': $('#category_id').val(),
                        'nama_barang': $('#nama_barang').val(),
                        'barcode': $('#barcode').val(),
                        'no_seri': $('#no_seri').val(),
                    }

                    $.ajax({
                        method: "POST",
                        data: data,
                        url: "{{ route('servicemasukasset.store') }}",
                        dataType: "json",
                        success: function(response){
                            if(response.statuc == 400){
                                $('#saveForm_errList').html("");
                                $('#saveForm_errList').addClass('alert alert-danger');
                                $.each(response.errors, function(key, err_values) {
                                    $('#saveForm_errList').append('<li>'+err_values+'</li>');
                                });
                            }else if(response.status == 200){
                                $('#saveForm_errList').html("");
                                $('#success_message').addClass('alert alert-success');
                                $('#success_message').text(response.messages);
                                $('#addServiceMasukAsset').modal('hide');
                                $('#addServiceMasukAsset').find("input").val("");
                                $('.modal-backdrop').remove();
                                var table = $('.datatables').DataTable();
                                table.ajax.reload();
                            }
                        }
                    })
                })
            })

            $(document).on('click', '.editServiceMasukAsset', function (e) {
                    e.preventDefault();

                    var id = $(this).data('id');

                    $('#updateServiceMasukAsset').modal('show');

                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('servicemasukasset.index') }}" + '/' + id + '/edit',
                        success: function (response) {
                            if (response.status == 404) {
                                $('#updateForm_errList').addClass('alert alert-success');
                                $('#updateForm_errList').text(response.message);
                                $('.editServiceMasukAsset').modal('hide');
                            }
                            else
                            {
                                $("#id").val(id);

                                $('#updateServiceMasukAsset').find('#antrianservice_id').val(response.antrian_services.name);
                                var option_antrian_service = '<option value = "'+response.antrian_services.id+'" selected> --- '+response.antrian_services.name+' --- </option>'
                                $('#updateServiceMasukAsset').find('select[name="antrianservice_id"]').append(option_antrian_service);

                                $('#updateServiceMasukAsset').find('#category_id').val(response.categories.category_name);
                                var option_antrian_service = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                                $('#updateServiceMasukAsset').find('select[name="category_id"]').append(option_antrian_service);

                                $('#updateServiceMasukAsset').find('#nama_barang').val(response.antrian_services.nama_barang);

                                $('#updateServiceMasukAsset').find('#barcode').val(response.antrian_services.barcode);
                                $('#updateServiceMasukAsset').find('#no_seri').val(response.antrian_services.no_seri);
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

                    var formData = {
                        antrianservice_id: $('#updateServiceMasukAssetForm').find('#antrianservice_id').val(),
                        category_id: $('#updateServiceMasukAssetForm').find('#category_id').val(),
                        nama_barang: $('#updateServiceMasukAssetForm').find('#nama_barang').val(),
                        barcode: $('#updateServiceMasukAssetForm').find('#barcode').val(),
                        no_seri: $('#updateServiceMasukAssetForm').find('#no_seri').val(),
                    };

                    console.log(formData);

                    $.ajax({
                        url: "/servicemasukasset/" + id,
                        method: 'PUT',
                        data: formData,
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
                                $('#updateServiceMasukAsset').find('input').val('');
                                $('.update').text('update');
                                $('#updateServiceMasukAsset').modal('hide');
                                $('.modal-backdrop').remove();
                                var table = $('.datatables').DataTable();
                                table.ajax.reload();
                            }
                        }
                    })
                });

                $(document).on('click', '.deleteServiceMasukAsset', function() {
                    var id = $('#id').val();

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
                            url: "servicemasukasset/" + id,
                            type: "DELETE",
                            dataType: "json",
                            success:function (response) {
                                if(response.status == 400  || response.status == 404)
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
                                    $('#updateServiceMasukAsset').modal('hide')
                                    var table = $('.datatables').DataTable()
                                    table.ajax.reload()
                                    location.reload()
                                }
                            }
                        })
                    })
                })

    </script>

@endsection