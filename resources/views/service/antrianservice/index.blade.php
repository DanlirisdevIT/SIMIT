@extends('template.layouts.app')

@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <h2 class="mb-4">Antrian Service</h2>
                                <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addAntrianService">
                                    Tambah
                                </button>

                                <br><br>
                                @csrf
                                <table class="table table-bordered datatables">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl</th>
                                            <th>Nama</th>
                                            <th>Unit</th>
                                            <th>Nama Barang</th>
                                            <th>Barcode</th>
                                            <th>IP/No Seri</th>
                                            <th>Status Service</th>
                                            <th>Prioritas</th>
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

        <div class="modal fade" id="addAntrianService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Antrian Service</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <ul id="saveForm_errList"></ul>
    
                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" id="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1" readonly>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label name="name" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama..." maxlength="50">
                        </div>
                    </div>
    
                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="unit_id" class="col-sm-4 control-label"> Pilih Unit </label>
                            <select class="form-control" id="unit_id" name="unit_id">
                                <option value="">Pilih  Unit----</option>
                                @foreach ($units as $unit)
                                    @if($unit->deletedBy == '')
                                        <option value={{ $unit->id }}>{{$unit->unit_name}}</option>
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
    
                    <div class="form-group">
                        <label name="status" class="col-sm-4 control-label"> Status </label>
                        <select class="form-control" id="status">
                            <option value="" selected="selected"> --Status-- </option>
                            <option value="Service Dalam"> Service Dalam </option>
                            <option value="Service Luar"> Service Luar </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="prioritas" class="col-sm-4 control-label"> Prioritas </label>
                        <select class="form-control" id="prioritas">
                            <option value="" selected="selected"> --Prioritas-- </option>
                            <option value="Prioritas"> Prioritas </option>
                            <option value="Non-Prioritas"> Non-Prioritas </option>
                        </select>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                    <button type="button" class="btn btn-primary create">Simpan</button>
                </div>
              </div>
            </div>
        </div>

        <div class="modal fade" id="updateAntrianService" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Edit Antrian Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
    
                        
                            <form id="updateAntrianServiceForm" name="updateAntrianServiceForm" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="modal-body" style="overflow:hidden;">
                                    <ul id="updateForm_errList"></ul>
                                    <input type="hidden" id="id">
    
                            <div class="form-group">
                                <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-alt" id="date"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1" readonly>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label name="name" class="col-sm-4 control-label"> Nama </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama Nama..." maxlength="50" required>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label name="unit_id" class="col-sm-4 control-label"> Pilih Unit </label>
                                <select class="form-control" id="unit_id" name="unit_id">
                                    @foreach ($units as $unit)
                                            @if($unit->deletedBy == '')
                                                <option value={{ $unit->id }}>{{$unit->unit_name}}</option>
                                            @endif
                                        @endforeach
                                </select>
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
                
                            <div class="form-group">
                                <label name="status" class="col-sm-4 control-label"> Status Service </label>
                                <select class="form-control" id="status" name="status">
                                    <option value="Service Dalam">Service Dalam</option>
                                    <option value="Service Luar">Service Luar</option>
                                </select>
                            </div>
                
                            <div class="form-group">
                                <label name="prioritas" class="col-sm-4 control-label"> Prioritas </label>
                                <select class="form-control" id="prioritas" name="prioritas">
                                    <option value="Prioritas">Prioritas</option>
                                    <option value="Non-Prioritas">Non-Prioritas</option>
                                </select>
                            </div>
    
                                </div>
                            </form>
                            <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                                <button type="button" class="btn btn-primary update">Perbaharui</button>
                                <button type="button" class="btn btn-danger deleteAntrianService"><i class="far fa-trash-alt"></i></button>
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
                ajax: "{{ route('antrianservice.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'date', name: 'date', width: '15%' },
                    {data: 'name', name: 'name', width: '15%'},
                    {data: 'units.unit_name', name: 'units.unit_name', width: '15%'},
                    {data: 'nama_barang', name: 'nama_barang', width: '15%'},
                    {data: 'barcode', name: 'barcode', width: '15%'},
                    {data: 'no_seri', name: 'no_seri', width: '15%'},
                    {data: 'status', name: 'status', width: '15%'},
                    {data: 'prioritas', name: 'prioritas', width: '15%'},
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
            $('#date').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                locale: 'en'
            });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date': $('#date').val(),
                    'name': $('#name').val(),
                    'unit_id': $('#unit_id').val(),
                    'nama_barang': $('#nama_barang').val(),
                    'barcode': $('#barcode').val(),
                    'no_seri': $('#no_seri').val(),
                    'status': $('#status').val(),
                    'prioritas': $('#prioritas').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('antrianservice.store') }}",
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
                            $('#addAntrianService').modal('hide');
                            $('#addAntrianService').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                        }
                    }
                })
            })
        })

        $(document).on('click', '.editAntrianService', function (e) {
                    e.preventDefault();

                    var id = $(this).data('id');

                    $('#updateAntrianService').modal('show');

                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('antrianservice.index') }}" + '/' + id + '/edit',
                        success: function (response) {
                            if (response.status == 404) {
                                $('#updateForm_errList').addClass('alert alert-success');
                                $('#updateForm_errList').text(response.message);
                                $('.editAntrianService').modal('hide');
                            }
                            else
                            {
                                $('#updateAntrianService').find('#date').datepicker({
                                    format: 'dd-mm-yyyy',
                                    autoclose: true,
                                    locale: 'en'
                                });

                                $("#id").val(id);

                                $('#updateAntrianService').find('#date').val(response.getDate);
                                $('#updateAntrianService').find('#name').val(response.antrian_services.name);

                                $('#updateAntrianService').find('#unit_id').val(response.units.unit_name);
                                var option_unit = '<option value = "'+response.units.id+'" selected> --- '+response.units.unit_name+' --- </option>'
                                $('#updateAntrianService').find('select[name="unit_id"]').append(option_unit);

                                $('#updateAntrianService').find('#nama_barang').val(response.antrian_services.nama_barang);
                                $('#updateAntrianService').find('#barcode').val(response.antrian_services.barcode);
                                $('#updateAntrianService').find('#no_seri').val(response.antrian_services.no_seri);
                                $('#updateAntrianService').find('#status').val(response.antrian_services.status);
                                $('#updateAntrianService').find('#prioritas').val(response.antrian_services.prioritas);
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
                        date: $('#updateAntrianServiceForm').find('#date').val(),
                        name: $('#updateAntrianServiceForm').find('#name').val(),
                        unit_id: $('#updateAntrianServiceForm').find('#unit_id').val(),
                        nama_barang: $('#updateAntrianServiceForm').find('#nama_barang').val(),
                        barcode: $('#updateAntrianServiceForm').find('#barcode').val(),
                        no_seri: $('#updateAntrianServiceForm').find('#no_seri').val(),
                        status: $('#updateAntrianServiceForm').find('#status').val(),
                        prioritas: $('#updateAntrianServiceForm').find('#prioritas').val(),
                    };

                    console.log(formData);

                    $.ajax({
                        url: "/antrianservice/" + id,
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
                                $('#updateAntrianService').find('input').val('');
                                $('.update').text('update');
                                $('#updateAntrianService').modal('hide');
                                $('.modal-backdrop').remove();
                                var table = $('.datatables').DataTable();
                                table.ajax.reload();
                            }
                        }
                    })
                });

                $(document).on('click', '.deleteAntrianService', function() {
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
                            url: "antrianservice/" + id,
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
                                    $('#updateAntrianService').modal('hide')
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