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
                                            <th>Sisa Hari</th>
                                            <th>Barcode</th>
                                            <th>Nama</th>
                                            <th>Divisi</th>
                                            <th>Unit</th>
                                            <th>Barang</th>
                                            <th>IP</th>
                                            <th>Status Service</th>
                                            <th>Prioritas</th>
                                            <th>Estimasi Perbaikan</th>
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
    
                    <!-- <div class="modal-body1">
                        <div class="form-group">
                            <label name="date_come" class="col-sm-4 control-label"> Tanggal Datang </label>
                            <div class="input-group mb-2">
                                <input type="date" class="form-control" id="date_come" name="date_come" aria-label="date" aria-describedby="basic-addon1"> -->
                                <!-- {{-- <div class="input-group-prepend">
                                    <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                                </div> --}} -->
                            <!-- </div>
                        </div>
                    </div> -->
    
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
                        <div class="dateComeForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="dateLeftForm"></div>
                    </div>

                    <div class="form-group">
                        <label name="danliris_history_id" class="col-sm-4 control-label"> Barcode </label>
                        <select class="form-control" data-live-search="true" id="danliris_history_id" name="danliris_history_id">
                            <option value="" selected="selected"> --Pilih-- </option>    
                            @foreach ($danliris_histories as $history)
                                @if($history->deletedBy == '')
                                        <option value={{ $history->id }}>{{$history->barcode}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label name="username" class="col-sm-4 control-label"> User </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..."  readonly>
                        </div>
                    </div> -->
                   
                    <!-- {{-- <div class="modal-body1">
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
                    </div> --}} -->

                    <!-- <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                        <select class="form-control" data-live-search="true" id="division_id" name="division_id" disabled>
                            @foreach ($divisions as $division)
                                @if($division->deletedBy == '')
                                        <option value={{ $division->id }}>{{$division->division_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> -->
                    <!-- <div class="form-group">
                        <label name="unit_id" class="col-sm-4 control-label"> Unit </label>
                        <select class="form-control" data-live-search="true" id="unit_id" name="unit_id" disabled>
                            @foreach ($units as $unit)
                                @if($unit->deletedBy == '')
                                        <option value={{ $unit->id }}>{{$unit->unit_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> -->
                    <!-- <div class="form-group">
                        <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                        <select class="form-control" data-live-search="true" id="asset_id" name="asset_id" disabled>
                            @foreach ($assets as $asset)
                                @if($asset->deletedBy == '')
                                        <option value={{ $asset->id }}>{{$asset->asset_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div> -->

                    <div class="form-group">
                        <div class="usernameForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="unitForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="divisiForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="barangForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="assetipForm"></div>
                    </div>

                    <!-- <div class="form-group">
                        <label name="asset_ip" class="col-sm-4 control-label"> IP </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="asset_ip" name="asset_ip" placeholder="Masukkan IP"  readonly>
                        </div>
                    </div> -->

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

                                    <div class="modal-body1">
                                    <div class="form-group">
                                        <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                                        <div class="input-group mb-2">
                                            <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1">
                                            <!-- {{-- <div class="input-group-prepend">
                                                <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                                            </div> --}} -->
                                        </div>
                                    </div>
                                </div>

                            <!-- {{-- <div class="form-group">
                                <label name="status" class="col-sm-4 control-label"> Status </label disabled>
                                <select class="form-control" id="status">
                                    <option value="" selected="selected"> --Status-- </option>
                                    <option value="Service Dalam"> Service Dalam </option>
                                    <option value="Service Luar"> Service Luar </option>
                                </select>
                            </div> --}} -->
                
                            <!-- {{-- <div class="form-group">
                                <label name="nama_teknisi" class="col-sm-4 control-label"> Nama Teknisi </label>
                                <input class="form-control" id="nama_teknisi" name="nama_teknisi" >
                            </div> --}} -->
                
                            <div class="form-group">
                                <label name="jenis_kerusakan" class="col-sm-4 control-label"> Jenis Kerusakan </label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="jenis_kerusakan" name="jenis_kerusakan" placeholder="Masukkan jenis kerusakan..."  ></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label name="tindakan_perbaikan" class="col-sm-4 control-label"> Tindakan Perbaikan </label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="tindakan_perbaikan" name="tindakan_perbaikan" placeholder="Masukkan tindakan perbaikan..."  ></textarea>
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
                                    <!-- <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-alt" id="date"></i></span>
                                    </div> -->
                                    <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1" readonly>
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
                                <label name="username" class="col-sm-4 control-label"> Username </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="username" name="username"  readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label name="unit_name" class="col-sm-4 control-label"> Unit </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="unit_name" name="unit_name"  readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label name="divisi_name" class="col-sm-4 control-label"> Divisi </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="divisi_name" name="divisi_name"  readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label name="asset_name" class="col-sm-4 control-label"> Barang </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="asset_name" name="asset_name"  readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label name="asset_ip" class="col-sm-4 control-label"> IP Address </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="asset_ip" name="asset_ip"  readonly>
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
                    {data: 'sisa_hari', name: 'sisa_hari', width: '15%' },
                    {data: 'danliris_histories.barcode', name: 'danliris_histories.barcode', width: '15%'},
                    {data: 'username', name: 'username', width: '15%'},
                    {data: 'divisi_name', name: 'divisi_name', width: '15%'},
                    {data: 'unit_name', name: 'unit_name', width: '15%'},
                    {data: 'asset_name', name: 'asset_name', width: '15%'},
                    {data: 'status', name: 'status', width: '15%'},
                    {data: 'prioritas', name: 'prioritas', width: '15%'},
                    {data: 'asset_ip', name: 'asset_ip', width: '15%'},
                    {data: 'time_remaining', name: 'time_remaining', width: '15%'},
                    {data: 'action', name: 'action', width: '5%'},
                ],
                order: [
                    [0, 'desc'],
                ],
                "rowCallback" : function(row, data, index)
                {
                    if(data.sisa_hari <= 3)
                    {
                        // $(row).addClass('redClass');
                        // $(row).find('td:eq(2)').css('background-color', 'red');
                        $(row).find('td').css('background-color', 'red');
                    
                        
                    }
                }
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

                            username = '<label name="username" class="col-sm-4 control-label"> Username </label>';
                            username = username + '<div class="col-sm-12">';
                            username = username + '<input type="text" class="form-control" id="username" name="username" value="'+response.danliris_histories.username+'"  readonly>';
                            username = username + '</div>';

                            asset_name = '<label name="asset_name" class="col-sm-4 control-label"> Nama Barang </label>';
                            asset_name = asset_name + '<div class="col-sm-12">';
                            asset_name = asset_name + '<input type="text" class="form-control" id="asset_name" name="asset_name" value="'+response.danliris_histories.asset_name+'"  readonly>';
                            asset_name = asset_name + '</div>';

                            unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                            unit = unit + '<div class="col-sm-12">';
                            unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value="'+response.danliris_histories.unit_name+'"  readonly>';
                            unit = unit + '</div>'
                            
                            divisi = '<label name="divisi_name" class="col-sm-4 control-label"> Divisi </label>';
                            divisi = divisi + '<div class="col-sm-12">';
                            divisi = divisi + '<input type="text" class="form-control" id="divisi_name" name="divisi_name" value="'+response.danliris_histories.division_name+'"  readonly>';
                            divisi = divisi + '</div>';
                            
                            asset_ip = '<label name="asset_ip" class="col-sm-4 control-label"> IP Address </label>';
                            asset_ip = asset_ip + '<div class="col-sm-12">';
                            asset_ip = asset_ip + '<input type="" class="form-control" id="asset_ip" name="asset_ip" value='+response.danliris_histories.asset_ip+'  readonly>';
                            asset_ip = asset_ip + '</div>';

                            var showForm_assetForm = $('.barangForm').html(asset_name);
                            var showForm_unitForm = $('.unitForm').html(unit);
                            var showForm_divisiForm = $('.divisiForm').html(divisi);
                            var showForm_username = $('.usernameForm').html(username);
                            var showForm_assetip = $('.assetipForm').html(asset_ip);
                            
                            showForm_assetForm.show();
                            showForm_unitForm.show();
                            showForm_divisiForm.show();
                            showForm_username.show();
                            showForm_assetip.show();

                            // $('#username').val(response.danliris_histories.username);

                            // $('#division_id').val(response.divisions.division_name);
                            // var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                            // $('select[name="division_id"]').append(option_division);

                            // $('#unit_id').val(response.units.unit_name);
                            // var option_unit = '<option value = "'+response.units.id+'" selected> --- '+response.units.unit_name+' --- </option>'
                            // $('select[name="unit_id"]').append(option_unit);

                            // $('#asset_id').val(response.assets.asset_name);
                            // var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                            // $('select[name="asset_id"]').append(option_asset);

                            // $('#asset_ip').val(response.danliris_histories.asset_ip);

                            // $('#barcode').val(response.danliris_histories.barcode);
                            }
                        }
                    })
            })

            $('.reset').click(function (){
                $('#date').val("")
                $('#danliris_history_id').val($('#danliris_history_id').data("default_value"))
                $('#username').val("")
                $('#divisi_name').val($('#divisi_name').data("default_value"))
                $('#unit_name').val($('#unit_name').data("default_value"))
                $('#asset_name').val($('#asset_name').data("default_value"))
                $('#asset_ip').val("")
                $('#status').val("")
                $('#prioritas').val("")
                $('#time_remaining').val("")
                $('#barcode').val("")
            })

            $('#status').on('change', function() {
                var status = $('#status').val();

                console.log(status)

                // dropdown = '<label name="remaining_time" class="col-sm-4 control-label"> Time Remaining </label>';
                // dropdown = dropdown + '<select class="form-control" id="time_remaining" name="time_remaining">';
                // dropdown = dropdown + '</select>';
                // var time_remain = ["3 hari", "lebih dari 3 hari"];

                dropdown = '<label name="remaining_time" class="col-sm-4 control-label"> Time Remaining </label>';
                dropdown = dropdown + '<select class="form-control" id="time_remaining" name="time_remaining">';
                dropdown = dropdown + '<option value="">-- Pilih Time Remaining --</option>';
                dropdown = dropdown + '<option value="3">3 Hari</option>';
                dropdown = dropdown + '<option value="60">3 Bulan</option>';
                dropdown = dropdown + '</select>';

                var showForm = $('.addedForm').html(dropdown);

                if(status === "Service Dalam") 
                {
                    showForm.show();

                    $('#time_remaining').on('change', function() 
                    {
                        var get_time = $('#time_remaining').val();

                        tanggal_datang ='<label name="date_come" class="col-sm-4 control-label"> Tanggal Datang </label>'
                        tanggal_datang = tanggal_datang + '<div class="input-group mb-2">'
                        tanggal_datang = tanggal_datang + '<input type="date" class="form-control" id="date_come" name="date_come" aria-label="date" aria-describedby="basic-addon1">'
                        tanggal_datang = tanggal_datang + '</div>'
                        tanggal_datang = tanggal_datang + '</div>'

                        tanggal_keluar = '<label name="date_left" class="col-sm-4 control-label"> Tanggal Keluar </label>';
                        tanggal_keluar = tanggal_keluar + '<div class="col-sm-12">';
                        tanggal_keluar = tanggal_keluar + '<input type="text" class="form-control" id="date_left" name="date_left" maxlength="50" readonly>';
                        tanggal_keluar = tanggal_keluar + '</div>';

                        var show_tanggalkeluar = $('.dateLeftForm').html(tanggal_keluar);

                        var show_tanggaldatang = $('.dateComeForm').html(tanggal_datang);

                        show_tanggaldatang.show();

                        if(get_time = 3)
                        {
                            $('#date_come').on('change', function() {
                                // var date_come = $('#date_come').val();
                                // console.log(date_come)
                                var a = new Date(this.value);
                                var hari = a.getDay();

                                if(hari == 4)
                                {
                                    var next_day = new Date(new Date().setDate(new Date(this.value).getDate() + 4)).toLocaleDateString();

                                    $('#date_left').val(next_day)
                                    
                                    show_tanggalkeluar.show();
                                }
                                else if(hari == 5)
                                {
                                    var next_day = new Date(new Date().setDate(new Date(this.value).getDate() + 5)).toLocaleDateString();
                                    
                                    $('#date_left').val(next_day)

                                    show_tanggalkeluar.show();
                                }
                                else
                                {
                                    var next_day = new Date(new Date().setDate(new Date(this.value).getDate() + 3)).toLocaleDateString();
                                    
                                    $('#date_left').val(next_day)
                                    
                                    show_tanggalkeluar.show();
                                }
                            })
                        }
                        else if(get_time = 60)
                        {
                            show_tanggaldatang.hide();
                            show_tanggalkeluar.hide();
                        }
                    })
                }
                else
                {
                    showForm.hide();
                }
            })

            // $('#date').datepicker({
            //     format: 'dd-mm-yyyy',
            //     autoclose: true,
            //     locale: 'en'
            // });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date_come': $('#date_come').val(),
                    'date_left': $('#date_left').val(),
                    'danliris_history_id': $('#danliris_history_id').val(),
                    'username': $('#username').val(),
                    // 'division_id': $('#division_id').val(),
                    'divisi_name': $('#divisi_name').val(),
                    'unit_name': $('#unit_name').val(),
                    'asset_name': $('#asset_name').val(),
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
                                        form = form +'<input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" value = "'+response.danliris_antrianservices.nama_teknisi+'"   required>';
                                        form = form +'</div>';
                                    var showForm = $(".addedForm1").html(form);
                                    showForm.show();
                                }
                                else if(status === 'Service Luar')
                                {
                                    var form = '<label name="nama_teknisi" class="col-sm-4 control-label"> Mitra Service Luar </label>';
                                    form = form +'<div class="col-sm-12">';
                                        form = form +'<input type="text" class="form-control" id="nama_teknisi" name="nama_teknisi" value = "'+response.danliris_antrianservices.nama_teknisi+'"   required>';
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
                                // $('#updateAntrianService').find('#date').datepicker({
                                // format: 'dd-mm-yyyy',
                                // autoclose: true,
                                // locale: 'en'
                                // $('#updateAntrianService').find('#date').datepicker({
                                // format: 'dd-mm-yyyy',
                                // autoclose: true,
                                // locale: 'en'
                            // });

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
                            //     $('#updateAntrianService1').find('#date').datepicker({
                            //     format: 'dd-mm-yyyy',
                            //     autoclose: true,
                            //     locale: 'en'
                            // });

                                $("#id").val(id);

                                $('#updateAntrianService1').find('#date').val(response.danliris_antrianservices.date);

                                // $('#updateAntrianService1').find('#danliris_history_id').val(response.danliris_antrianservices.barcode);
                                var option_barcode = '<option value = "'+response.danliris_histories.id+'" selected> --- '+response.danliris_histories.barcode+' --- </option>'
                                $('#updateAntrianService1').find('select[name="danliris_history_id"]').append(option_barcode);
                                $('#updateAntrianService1').find('#username').val(response.danliris_antrianservices.username);
                                $('#updateAntrianService1').find('#unit_name').val(response.danliris_antrianservices.unit_name);
                                $('#updateAntrianService1').find('#divisi_name').val(response.danliris_antrianservices.divisi_name);
                                $('#updateAntrianService1').find('#asset_name').val(response.danliris_antrianservices.asset_name);
                                $('#updateAntrianService1').find('#asset_ip').val(response.danliris_antrianservices.asset_ip);
                                // $('#updateAntrianService1').find('#status').val(response.danliris_antrianservices.status);
                                var option_status = '<option value = "'+response.danliris_antrianservices.status+'" selected> --- '+response.danliris_antrianservices.status+' --- </option>'
                                $('#updateAntrianService1').find('select[name="status"]').append(option_status);
                                // $('#updateAntrianService1').find('#prioritas').val(response.danliris_antrianservices.prioritas);
                                var option_prioritas = '<option value = "'+response.danliris_antrianservices.prioritas+'" selected> --- '+response.danliris_antrianservices.prioritas+' --- </option>'
                                $('#updateAntrianService1').find('select[name="prioritas"]').append(option_prioritas);
                                
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