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
                                    Add
                                </button>

                                <br><br>
                                @csrf
                                <table class="table table-bordered datatables">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Barcode</th>
                                            <th>Nama</th>
                                            <th>Divisi</th>
                                            <th>Unit</th>
                                            <th>Barang</th>
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
                  <h5 class="modal-title">Form Add Service</h5>
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
                        <label name="danliris_history_id" class="col-sm-4 control-label"> Barcode </label>
                        <select class="form-control" data-live-search="true" id="danliris_history_id" name="danliris_history_id">
                            @foreach ($danliris_histories as $history)
                                @if($history->deletedBy == '')
                                        <option value={{ $history->id }}>{{$history->barcode}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="username" class="col-sm-4 control-label"> User </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." maxlength="50" readonly>
                        </div>
                    </div>
                   
                    {{-- <div class="modal-body1">
                        <div class="form-group">
                            <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                            <input class="form-control" id="division_id" name="division_id" disabled>
                        </div>
                    </div>

                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="unit_id" class="col-sm-4 control-label"> Unit </label>
                            <input class="form-control" id="unit_id" name="unit_id" disabled>
                        </div>
                    </div>

                    <div class="modal-body1">
                        <div class="form-group">
                            <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                            <input class="form-control" id="asset_id" name="asset_id" disabled>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                        <select class="form-control" data-live-search="true" id="division_id" name="division_id" disabled>
                            @foreach ($divisions as $division)
                                @if($division->deletedBy == '')
                                        <option value={{ $division->id }}>{{$division->division_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label name="unit_id" class="col-sm-4 control-label"> Unit </label>
                        <select class="form-control" data-live-search="true" id="unit_id" name="unit_id" disabled>
                            @foreach ($units as $unit)
                                @if($unit->deletedBy == '')
                                        <option value={{ $unit->id }}>{{$unit->unit_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                        <select class="form-control" data-live-search="true" id="asset_id" name="asset_id" disabled>
                            @foreach ($assets as $asset)
                                @if($asset->deletedBy == '')
                                        <option value={{ $asset->id }}>{{$asset->asset_name}}</option>
                                @endif
                            @endforeach
                        </select>
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

                    {{-- <div class="form-group">
                        <label name="time_remaining" class="col-sm-4 control-label"> Waktu Tersisa </label>
                        <select class="form-control" id="time_remaining">
                            <option value="" selected="selected"> --Waktu Tersisa-- </option>
                            <option value="Service Dalam"> 3 hari </option>
                            <option value="Service Luar"> Lebih dari 3 hari </option>
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <div class="addedForm"></div>
                    </div>

                    <div class="form-group">
                        <label name="barcode" class="col-sm-4 control-label">  </label>
                        <div class="">
                            <input type="text" class="form-control" id="barcode" name="barcode" hidden>
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                    <button type="button" class="btn btn-primary create">Save</button>
                </div>
              </div>
            </div>
        </div>

        {{-- Form Selesai --}}
        <div class="modal fade" id="updateAntrianService" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Form Selesai Service</h5>
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

                            {{-- <div class="form-group">
                                <label name="status" class="col-sm-4 control-label"> Status </label disabled>
                                <select class="form-control" id="status">
                                    <option value="" selected="selected"> --Status-- </option>
                                    <option value="Service Dalam"> Service Dalam </option>
                                    <option value="Service Luar"> Service Luar </option>
                                </select>
                            </div> --}}
                
                            {{-- <div class="form-group">
                                <label name="nama_teknisi" class="col-sm-4 control-label"> Nama Teknisi </label>
                                <input class="form-control" id="nama_teknisi" name="nama_teknisi" >
                            </div> --}}
                
                            <div class="form-group">
                                <label name="jenis_kerusakan" class="col-sm-4 control-label"> Jenis Kerusakan </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="jenis_kerusakan" name="jenis_kerusakan" placeholder="Masukan jenis kerusakan..." maxlength="50" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label name="tindakan_perbaikan" class="col-sm-4 control-label"> Tindakan Perbaikan </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="tindakan_perbaikan" name="tindakan_perbaikan" placeholder="Masukan tindakan perbaikan..." maxlength="50" >
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="addedForm1"></div>
                            </div>

                            {{-- <div class="form-group">
                                <div class="addedForm2"></div>
                            </div>

                            <div class="form-group">
                                <div class="addedForm3"></div>
                            </div> --}}
    
                                </div>
                        </form>
                            <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success update">Done</button>
                            </div>
                </div>
            </div>
        </div>

        {{-- Form Edit --}}
        <div class="modal fade" id="updateAntrianService1" role="dialog" aria-labelledby="updateModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Form Edit Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
    
                        
                            <form id="updateAntrianService1Form" name="updateAntrianService1Form" class="form-horizontal">
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
                                <label name="danliris_history_id" class="col-sm-4 control-label"> Barcode </label>
                                <select class="form-control" id="danliris_history_id" name="danliris_history_id" disabled>
                                    @foreach ($danliris_histories as $history)
                                            @if($history->deletedBy == '')
                                                <option value={{ $history->id }}>{{$history->barcode}}</option>
                                            @endif
                                        @endforeach
                                </select>
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

                            {{-- <div class="form-group">
                                <div class="addedForm"></div>
                            </div> --}}

                        </div>
                        </form>
                            <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger deleteAntrianService">Delete</button>
                                <button type="button" class="btn btn-primary update1">Edit</button>
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
                ajax: "{{ route('danliris_antrianservice.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'date', name: 'date', width: '15%' },
                    {data: 'danliris_histories.barcode', name: 'danliris_histories.barcode', width: '15%'},
                    {data: 'username', name: 'username', width: '15%'},
                    {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
                    {data: 'units.unit_name', name: 'units.unit_name', width: '15%'},
                    {data: 'assets.asset_name', name: 'assets.asset_name', width: '15%'},
                    {data: 'status', name: 'status', width: '15%'},
                    {data: 'prioritas', name: 'prioritas', width: '15%'},
                    {data: 'asset_ip', name: 'asset_ip', width: '15%'},
                    {data: 'time_remaining', name: 'time_remaining', width: '15%'},
                    {data: 'action', name: 'action', width: '5%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        })

        // $('#danliris_history_id').select2({
        //     theme: 'booststrap4'
        // })

        $(document).ready(function () {
            $("#danliris_history_id").on('change', function() {
                    var danliris_history_id = $("#danliris_history_id").val();
                    console.log(danliris_history_id)

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: "{{ route('danliris_antrianservice.create') }}",
                        data:  { 'danliris_history_id' : danliris_history_id },
                        dataType: "json",
                        beforeSend : function()
                        {
                            console.log(danliris_history_id);
                        },
                        success: function(response){
                            if(response.status == 200)
                            {
                            $('#username').val(response.danliris_histories.username);

                            $('#division_id').val(response.divisions.division_name);
                            var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                            $('select[name="division_id"]').append(option_division);

                            $('#unit_id').val(response.units.unit_name);
                            var option_unit = '<option value = "'+response.units.id+'" selected> --- '+response.units.unit_name+' --- </option>'
                            $('select[name="unit_id"]').append(option_unit);

                            $('#asset_id').val(response.assets.asset_name);
                            var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                            $('select[name="asset_id"]').append(option_asset);

                            $('#asset_ip').val(response.danliris_histories.asset_ip);

                            $('#barcode').val(response.danliris_histories.barcode);
                            }
                        }
                    })
            })

            $('.reset').click(function (){
                $('#date').val("")
                $('#danliris_history_id').val($('#danliris_history_id').data("default_value"))
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

                    $.each(time_remain, function(index, danliris_antrianservices) {
                        $('select[name="time_remaining"]').append('<option value="'+danliris_antrianservices+'">'+danliris_antrianservices+'</option>')
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
                    'danliris_history_id': $('#danliris_history_id').val(),
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
                    url: "{{ route('danliris_antrianservice.store') }}",
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

        $('#status').on('change', function() {
            if(status === 'Service Dalam')
                                {
                                    var form = '<label name="nama_teknisi" class="col-sm-4 control-label"> Nama Teknisi </label>';
                                    form = form +'<div class="col-sm-12">';
                                        form = form +'<input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" value = "'+response.danliris_antrianservices.nama_teknisi+'"  maxlength="50" required>';
                                        form = form +'</div>';
                                    var showForm = $(".addedForm1").html(form);
                                    showForm.show();
                                }
                                else if(status === 'Service Luar')
                                {
                                    var form = '<label name="nama_teknisi" class="col-sm-4 control-label"> Mitra Service Luar </label>';
                                    form = form +'<div class="col-sm-12">';
                                        form = form +'<input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" value = "'+response.danliris_antrianservices.nama_teknisi+'"  maxlength="50" required>';
                                        form = form +'</div>';
                                    var showForm = $(".addedForm1").html(form);
                                    showForm.show();
                                }
        })

        //button done
        $(document).on('click', '.editAntrianService', function (e) {
                    e.preventDefault();

                    var id = $(this).data('id');

                    $('#updateAntrianService').modal('show');

                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('danliris_antrianservice.index') }}" + '/' + id + '/edit',
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
                                // $('#updateAntrianService').find('#date').datepicker({
                                // format: 'dd-mm-yyyy',
                                // autoclose: true,
                                // locale: 'en'
                            });

                                $("#id").val(id);

                                $('#updateAntrianService').find('#date').val(response.danliris_antrianservices.date);

                                $('#updateAntrianService').find('#status').val(response.danliris_antrianservices.status);
                                
                                $('#updateAntrianService').find('#nama_teknisi').val(response.danliris_antrianservices.nama_teknisi);
                                $('#updateAntrianService').find('#jenis_kerusakan').val(response.danliris_antrianservices.jenis_kerusakan);
                                $('#updateAntrianService').find('#tindakan_perbaikan').val(response.danliris_antrianservices.tindakan_perbaikan);

                                
                            }
                        }
                    });
                });

                $(document).on('click', '.update', function (e) {
                    e.preventDefault();

                    $(this).text("Done");

                    var id = $('#id').val();

                    console.log(id)

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var formData = {
                        date: $('#updateAntrianServiceForm').find('#date').val(),
                        // tgl_selesai: $('#updateAntrianServiceForm').find('#tgl_selesai').val(),
                        danliris_history_id: $('#updateAntrianServiceForm').find('#danliris_history_id').val(),
                        nama_teknisi: $('#updateAntrianServiceForm').find('#nama_teknisi').val(),
                        jenis_kerusakan: $('#updateAntrianServiceForm').find('#jenis_kerusakan').val(),
                        tindakan_perbaikan: $('#updateAntrianServiceForm').find('#tindakan_perbaikan').val(),
                    };

                    console.log(formData);

                    $.ajax({
                        url: "/danliris_antrianservice/" + id,
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

                //button edit
                $(document).on('click', '.editAntrianService1', function (e) {
                    e.preventDefault();

                    var id = $(this).data('id');

                    $('#updateAntrianService1').modal('show');

                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('danliris_antrianservice.index') }}" + '/' + id + '/edit1',
                        success: function (response) {
                            if (response.status == 404) {
                                $('#updateForm_errList').addClass('alert alert-success');
                                $('#updateForm_errList').text(response.message);
                                $('.editAntrianService1').modal('hide');
                            }
                            else
                            {
                                $('#updateAntrianService1').find('#date').datepicker({
                                format: 'dd-mm-yyyy',
                                autoclose: true,
                                locale: 'en'
                            });

                                $("#id").val(id);

                                $('#updateAntrianService1').find('#date').val(response.danliris_antrianservices.date);

                                $('#updateAntrianService1').find('#danliris_history_id').val(response.danliris_histories.barcode);
                                var option_barcode = '<option value = "'+response.danliris_histories.id+'" selected> --- '+response.danliris_histories.barcode+' --- </option>'
                                $('#updateAntrianService1').find('select[name="danliris_history_id"]').append(option_barcode);
                                $('#updateAntrianService1').find('#status').val(response.danliris_antrianservices.status);
                                $('#updateAntrianService1').find('#prioritas').val(response.danliris_antrianservices.prioritas);
                                
                            }
                        }
                    });
                });

                $(document).on('click', '.update1', function (e) {
                    e.preventDefault();

                    $(this).text("Updating...");

                    var id = $('#id').val();

                    console.log(id)

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var formData = {
                        date: $('#updateAntrianService1Form').find('#date').val(),
                        danliris_history_id: $('#updateAntrianService1Form').find('#danliris_history_id').val(),
                        status: $('#updateAntrianService1Form').find('#status').val(),
                        prioritas: $('#updateAntrianService1Form').find('#prioritas').val(),
                    };

                    console.log(formData);

                    $.ajax({
                        url: "danliris_antrianservice/" + id,
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
                                $('.update1').text('update1');
                            }
                            else
                            {
                                $('#updateForm_errList').html("");
                                $('#success_message').addClass('alert alert-success');
                                $('#success_message').text(response.messages);
                                $('#updateAntrianService1').find('input').val('');
                                $('.update1').text('update1');
                                $('#updateAntrianService1').modal('hide');
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
                    show = show+'Delete this data?';
                    show = show+'<button style="float: right; font-weight: 900;" type="button" class="btn btn-danger delete">Delete Data?</button>';
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
                            url: "danliris_antrianservice/" + id,
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