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
                                            <th>Barcode</th>
                                            <th>Nama</th>
                                            <th>Divisi</th>
                                            <th>Unit</th>
                                            <th>Nama Barang</th>
                                            <th>IP</th>
                                            <th>Status Service</th>
                                            <th>Prioritas</th>
                                            <th>Waktu Tersisa</th>
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
    
                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="efrata_history_id" class="col-sm-4 control-label"> Pilih Barcode </label>
                            <select class="form-control" id="efrata_history_id" name="efrata_history_id">
                                <option value="">--Pilih  Barcode--</option>
                                @foreach ($efrata_histories as $history)
                                    @if($history->deletedBy == '')
                                        <option value={{ $history->id }}>{{$history->barcode}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                            <select class="form-control" id="division_id" name="division_id" disabled>
                                {{-- @foreach ($units as $unit)
                                    @if($unit->deletedBy == '')
                                        <option value={{ $unit->id }}>{{$unit->unit_name}}</option>
                                    @endif
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="unit_id" class="col-sm-4 control-label"> Unit </label>
                            <select class="form-control" id="unit_id" name="unit_id" disabled>
                                 {{-- @foreach ($categories as $category)
                                    @if($category->deletedBy == '')
                                        <option value={{ $category->id }}>{{$category->category_name}}</option>
                                    @endif
                                @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                            <select class="form-control" id="asset_id" name="asset_id" disabled>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="asset_ip" class="col-sm-4 control-label"> IP </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="asset_ip" name="asset_ip" placeholder="Masukkan IP" maxlength="50" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="prioritas" class="col-sm-4 control-label"> Prioritas </label>
                        <select class="form-control" id="prioritas">
                            <option value="" selected="selected"> --Pilih-- </option>
                            <option value="Prioritas"> Prioritas </option>
                            <option value="Non-Prioritas"> Non-Prioritas </option>
                        </select>
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
                        <div class="addedForm"></div>
                    </div>

                    <div class="form-group">
                        <label name="barcode" class="col-sm-4 control-label"> </label>
                        <div >
                            <input type="text" class="form-control" id="barcode" name="barcode"  maxlength="50" hidden>
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
                                <label name="efrata_history_id" class="col-sm-4 control-label"> Barcode </label>
                                <select class="form-control" id="efrata_history_id" name="efrata_history_id">
                                    @foreach ($efrata_histories as $history)
                                            @if($history->deletedBy == '')
                                                <option value={{ $history->id }}>{{$history->barcode}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label name="username" class="col-sm-4 control-label"> Nama </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." maxlength="50" required>
                                </div>
                            </div>
                
                            <div class="form-group">
                                <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                                <select class="form-control" id="division_id" name="division_id" disabled>
                                </select>
                            </div>

                            <div class="modal-body1">
                                <div class="form-group">
                                    <label name="unit_id" class="col-sm-4 control-label"> Unit </label>
                                    <select class="form-control" id="unit_id" name="unit_id" disabled>
                                        {{-- @foreach ($categories as $category)
                                            @if($category->deletedBy == '')
                                            <option value={{ $category->id }}>{{$category->category_name}}</option>
                                        @endif
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                                <select class="form-control" id="asset_id" name="asset_id" disabled>
                                </select>
                            </div>

                            <div class="form-group">
                                <label name="asset_ip" class="col-sm-4 control-label"> IP </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="asset_ip" name="asset_ip" placeholder="Masukkan IP..." maxlength="50" readonly>
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
                ajax: "{{ route('efrata_antrianservice.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'date', name: 'date', width: '15%' },
                    {data: 'efrata_histories.barcode', name: 'efrata_histories.barcode', width: '15%'},
                    {data: 'username', name: 'username', width: '15%'},
                    {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
                    {data: 'units.unit_name', name: 'units.unit_name', width: '15%'},
                    {data: 'assets.asset_name', name: 'assets.asset_name', width: '15%'},
                    {data: 'asset_ip', name: 'asset_ip', width: '15%'},
                    {data: 'status', name: 'status', width: '15%'},
                    {data: 'prioritas', name: 'prioritas', width: '15%'},
                    {data: 'time_remaining', name: 'time_remaining', width: '15%'},
                    {data: 'action', name: 'action', width: '5%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        })

        $(document).ready(function () {
            $("#efrata_history_id").on('change', function() {
                    var efrata_history_id = $("#efrata_history_id").val();
                    console.log(efrata_history_id)

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: "{{ route('efrata_antrianservice.create') }}",
                        data:  { 'efrata_history_id' : efrata_history_id },
                        dataType: "json",
                        beforeSend : function()
                        {
                            console.log(efrata_history_id);
                        },
                        success: function(response){
                            if(response.status == 200)
                            {
                            $('#username').val(response.efrata_histories.username);

                            $('#division_id').val(response.divisions.division_name);
                            var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                            $('select[name="division_id"]').append(option_division);

                            $('#unit_id').val(response.units.unit_name);
                            var option_unit = '<option value = "'+response.units.id+'" selected> --- '+response.units.unit_name+' --- </option>'
                            $('select[name="unit_id"]').append(option_unit);

                            $('#asset_id').val(response.assets.asset_name);
                            var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                            $('select[name="asset_id"]').append(option_asset);

                            $('#asset_ip').val(response.efrata_histories.asset_ip);
                            $('#barcode').val(response.efrata_histories.barcode);
                            }
                        }
                    })
            })

            $('.reset').click(function (){
                $('#date').val("")
                $('#efrata_history_id').val($('#efrata_history_id').data("default_value"))
                $('#username').val("")
                $('#division_id').val($('#division_id').data("default_value"))
                $('#unit_id').val($('#unit_id').data("default_value"))
                $('#asset_id').val($('#asset_id').data("default_value"))
                $('#asset_ip').val("")
                $('#status').val("")
                $('#prioritas').val("")
                $('#time_remaining').val("")
                $('#barcode').val("")
            })

            $('#status').on('change', function() {
                var status = $('#status').val();

                console.log(status)

                dropdown = '<label name="remaining_time" class="col-sm-4 control-label"> Time Remaining </label>';
                dropdown = dropdown + '<select class="form-control" id="time_remaining" name="time_remaining">';
                dropdown = dropdown + '</select>';

                var showForm = $('.addedForm').html(dropdown);

                var time_remain = ["3 hari", "lebih dari 3 hari"];

                if(status === "Service Dalam") {
                    // var showForm = $('#.addedForm').html(dropdown);

                    $.each(time_remain, function(index, efrata_antrianservices) {
                        $('select[name="time_remaining"]').append('<option value="'+efrata_antrianservices+'">'+efrata_antrianservices+'</option>')
                    })
                    showForm.show();
                }
                else if(status === "Service Luar") {
                    showForm.hide();
                }
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
                    'efrata_history_id': $('#efrata_history_id').val(),
                    'username': $('#username').val(),
                    'division_id': $('#division_id').val(),
                    'unit_id': $('#unit_id').val(),
                    'asset_id': $('#asset_id').val(),
                    'asset_ip': $('#asset_ip').val(),
                    'status': $('#status').val(),
                    'prioritas': $('#prioritas').val(),
                    'time_remaining': $('#time_remaining').val(),
                    'barcode': $('#barcode').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('efrata_antrianservice.store') }}",
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
                        url: "{{ route('efrata_antrianservice.index') }}" + '/' + id + '/edit',
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

                                $('#updateAntrianService').find('#date').val(response.efrata_antrianservices.date);

                                $('#updateAntrianService').find('#nama_teknisi').val(response.efrata_antrianservices.nama_teknisi);
                                $('#updateAntrianService').find('#jenis_kerusakan').val(response.efrata_antrianservices.jenis_kerusakan);
                                $('#updateAntrianService').find('#tindakan_perbaikan').val(response.efrata_antrianservices.tindakan_perbaikan);


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
                        nama_teknisi: $('#updateAntrianServiceForm').find('#nama_teknisi').val(),
                        jenis_kerusakan: $('#updateAntrianServiceForm').find('#jenis_kerusakan').val(),
                        tindakan_perbaikan: $('#updateAntrianServiceForm').find('#tindakan_perbaikan').val(),
                    };

                    console.log(formData);

                    $.ajax({
                        url: "/efrata_antrianservice/" + id,
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
                            url: "efrata_antrianservice/" + id,
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