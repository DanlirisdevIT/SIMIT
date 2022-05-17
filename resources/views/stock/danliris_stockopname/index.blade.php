@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Stock Opname</h2>

                        
                        
                                {{-- notifikasi form validasi --}}
                                @if ($errors->has('file'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file') }}</strong>
                                </span>
                                @endif
                        
                                {{-- notifikasi success --}}
                                {{-- @if ($success = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button> 
                                    <strong>{{ $success }}</strong>
                                </div>
                                @endif --}}
                        
                                <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                                    Upload Excel
                                </button>
                                
                                <br><br>

                                <div class="col-md-6">
                                    <a href="{{ route('danliris_stockopname.export') }}" class="btn btn-info">
                                        Download Template
                                    </a>
                                </div>
                        
                                <!-- Import Excel -->
                                <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="POST" action="{{ route('danliris_stockopname.import') }}" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload Excel</h5>
                                                </div>
                                                <div class="modal-body">
                        
                                                    {{ csrf_field() }}
                        
                                                    <label>Pilih file excel</label>
                                                    <div class="form-group">
                                                        <input type="file" name="file" required="required">
                                                    </div>
                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <br><br>
                                <div class="row input-daterange">
                                    <div class="col-md-4">
                                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                                    </div>
                                </div>
                        
                                <br>
                                @csrf
                                <table class='table table-bordered datatables'>
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Nama Barang</th>
                                            <th>Pabrikan</th>
                                            <th>Merk</th>
                                            <th>Processor</th>
                                            <th>Power Supply</th>
                                            <th>Casing</th>
                                            <th>HDD Slot 1</th>
                                            <th>HDD Slot 2</th>
                                            <th>Ram Slot 1</th>
                                            <th>Ram Slot 2</th>
                                            <th>Fan Processor</th>
                                            <th>Dvd Internal</th>
                                            <th>IP</th>
                                            <th>Perusahaan</th>
                                            <th>Divisi</th>
                                            <th>Unit</th>
                                            <th>Lokasi</th>
                                            <th>Status</th>
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

    <div class="modal fade" id="updateStockOpname" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Stock Opname</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

                    <form id="updateStockOpnameForm" name="updateStockOpnameForm" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="overflow:hidden;">
                            <ul id="updateForm_errList"></ul>
                            <input type="hidden" id="id">
    
                    <div class="form-group">
                        <label name="username" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan nama..." maxlength="50" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="nama_barang" class="col-sm-4 control-label"> Nama Barang </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="manufacture" class="col-sm-4 control-label"> Nama Perusahaan </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="manufacture" name="manufacture" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="merk" class="col-sm-4 control-label"> Nama Brand </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="merk" name="merk" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="processor" class="col-sm-4 control-label"> Processor </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="processor" name="processor" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="power_supply" class="col-sm-4 control-label"> Power Supply </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="power_supply" name="power_supply" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="casing" class="col-sm-4 control-label"> Casing </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="casing" name="casing" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="hddslot1" class="col-sm-4 control-label"> HDD Slot 1 </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="hddslot1" name="hddslot1" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="hddslot2" class="col-sm-4 control-label"> HDD Slot 2 </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="hddslot2" name="hddslot2" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="ramslot1" class="col-sm-4 control-label"> RAM Slot 1 </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ramslot1" name="ramslot1" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="ramslot2" class="col-sm-4 control-label"> RAM Slot 2 </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ramslot2" name="ramslot2" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="fan_processor" class="col-sm-4 control-label"> Fan Processor </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="fan_processor" name="fan_processor" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="dvd_internal" class="col-sm-4 control-label"> DVD Internal </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="dvd_internal" name="dvd_internal" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="asset_ip" class="col-sm-4 control-label"> IP Address </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="asset_ip" name="asset_ip" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="company" class="col-sm-4 control-label"> Perusahaan </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="company" name="company" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="divisi" class="col-sm-4 control-label"> Divisi </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="divisi" name="divisi" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="unit" class="col-sm-4 control-label"> Unit </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="unit" name="unit" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="location" class="col-sm-4 control-label"> Lokasi </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="location" name="location" maxlength="50">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="status" class="col-sm-4 control-label"> Status </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="status" name="status" maxlength="50">
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                    <button type="button" class="btn btn-primary update">Perbaharui</button>
                </div>
            </form>
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

            $('.input-daterange').datepicker({
                    todayBtn:'linked',
                    format:'yyyy-mm-dd',
                    autoclose: true
                });
            
                load_data();

            function load_data(from_date = '', to_date = '')
            {
                var table = $('.datatables').DataTable({
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('danliris_stockopname.index') }}",
                        data: {from_date: from_date, to_date: to_date}
                    },
                    method: 'GET',
                    destroy: true,
                    columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                            {data: 'username', name: 'username', width: '15%'},
                            {data: 'nama_barang', name: 'nama_barang', width: '15%'},
                            {data: 'manufacture', name: 'manufacture', width: '15%'},
                            {data: 'merk', name: 'merk', width: '15%'},
                            {data: 'processor', name: 'processor', width: '15%'},
                            {data: 'power_supply', name: 'power_supply', width: '15%'},
                            {data: 'casing', name: 'casing', width: '15%'},
                            {data: 'hddslot1', name: 'hddslot1', width: '15%'},
                            {data: 'hddslot2', name: 'hddslot2', width: '15%'},
                            {data: 'ramslot1', name: 'ramslot1', width: '15%'},
                            {data: 'ramslot2', name: 'ramslot2', width: '15%'},
                            {data: 'fan_processor', name: 'fan_processor', width: '15%'},
                            {data: 'dvd_internal', name: 'dvd_internal', width: '15%'},
                            {data: 'asset_ip', name: 'asset_ip', width: '15%'},
                            {data: 'company', name: 'company', width: '15%'},
                            {data: 'divisi', name: 'divisi', width: '15%'},
                            {data: 'unit', name: 'unit', width: '15%'},
                            {data: 'location', name: 'location', width: '15%'},
                            {data: 'status', name: 'status', width: '15%'},
                            {data: 'action', name: 'action', width: '5%'},
                        ],
                        order: [
                            [0, 'desc'],
                        ],
                });
            }

            $(document).ready(function () {
                

                $('#filter').click(function(){
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    if(from_date != '' && to_date != '')
                    {
                        $('#datatables').DataTable().destroy();
                        load_data(from_date, to_date);
                    }
                    else
                    {
                        alert('date is required');
                    }
                });

                $('#refresh').click(function(){
                    $('#from_date').val('');
                    $('#to_date').val('');
                    $('#datatables').DataTable().destroy();
                    load_data();
                });

            });

            $(document).on('click', '.editStockOpname', function (e){

                e.preventDefault();

                var id = $(this).data('id');

                $('#updateStockOpname').modal('show');

                $.ajax({
                    type: "GET",
                    url: "{{ route('danliris_stockopname.index') }}" + '/' + id + '/edit',
                    success: function(response){
                        if (response.status == 404) {
                            $('#updateForm_errList').addClass('alert alert-success');
                            $('#updateForm_errList').text(response.message);
                            $('.editStockOpname').modal('hide');
                        }
                        else
                        {
                            $("#id").val(id);

                            $('#updateStockOpname').find("#username").val(response.danliris_stocklists.username);
                            $('#updateStockOpname').find("#nama_barang").val(response.danliris_stocklists.nama_barang);
                            $('#updateStockOpname').find("#manufacture").val(response.danliris_stocklists.manufacture);
                            $('#updateStockOpname').find("#merk").val(response.danliris_stocklists.merk);
                            $('#updateStockOpname').find("#processor").val(response.danliris_stocklists.processor);
                            $('#updateStockOpname').find("#power_supply").val(response.danliris_stocklists.power_supply);
                            $('#updateStockOpname').find("#casing").val(response.danliris_stocklists.casing);
                            $('#updateStockOpname').find("#hddslot1").val(response.danliris_stocklists.hddslot1);
                            $('#updateStockOpname').find("#hddslot2").val(response.danliris_stocklists.hddslot2);
                            $('#updateStockOpname').find("#ramslot1").val(response.danliris_stocklists.ramslot1);
                            $('#updateStockOpname').find("#ramslot2").val(response.danliris_stocklists.ramslot2);
                            $('#updateStockOpname').find("#fan_processor").val(response.danliris_stocklists.fan_processor);
                            $('#updateStockOpname').find("#dvd_internal").val(response.danliris_stocklists.dvd_internal);
                            $('#updateStockOpname').find("#asset_ip").val(response.danliris_stocklists.asset_ip);
                            $('#updateStockOpname').find("#company").val(response.danliris_stocklists.company);
                            $('#updateStockOpname').find("#divisi").val(response.danliris_stocklists.divisi);
                            $('#updateStockOpname').find("#unit").val(response.danliris_stocklists.unit);
                            $('#updateStockOpname').find("#location").val(response.danliris_stocklists.location);
                            $('#updateStockOpname').find("#status").val(response.danliris_stocklists.status);
                        }
                    }
                })
            });

            $(document).on('click', '.update', function(e) {
                e.preventDefault();

                $(this).text('Memperbaharui...');

                var id = $('#id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = {
                    username: $('#updateStockOpnameForm').find('#username').val(),
                    nama_barang: $('#updateStockOpnameForm').find('#nama_barang').val(),
                    manufacture: $('#updateStockOpnameForm').find('#manufacture').val(),
                    merk: $('#updateStockOpnameForm').find('#merk').val(),
                    processor: $('#updateStockOpnameForm').find('#processor').val(),
                    power_supply: $('#updateStockOpnameForm').find('#power_supply').val(),
                    casing: $('#updateStockOpnameForm').find('#casing').val(),
                    hddslot1: $('#updateStockOpnameForm').find('#hddslot1').val(),
                    hddslot2: $('#updateStockOpnameForm').find('#hddslot2').val(),
                    ramslot1: $('#updateStockOpnameForm').find('#ramslot1').val(),
                    ramslot2: $('#updateStockOpnameForm').find('#ramslot2').val(),
                    fan_processor: $('#updateStockOpnameForm').find('#fan_processor').val(),
                    dvd_internal: $('#updateStockOpnameForm').find('#dvd_internal').val(),
                    asset_ip: $('#updateStockOpnameForm').find('#asset_ip').val(),
                    company: $('#updateStockOpnameForm').find('#company').val(),
                    divisi: $('#updateStockOpnameForm').find('#divisi').val(),
                    unit: $('#updateStockOpnameForm').find('#unit').val(),
                    location: $('#updateStockOpnameForm').find('#location').val(),
                    status: $('#updateStockOpnameForm').find('#status').val(),
                }
                console.log(formData);

                $.ajax({
                    url: "/danliris_stockopname/" + id,
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
                            $('#updateStockOpname').find('input').val('');
                            $('.update').text('update');
                            $('#updateStockOpname').modal('hide');
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                            location.reload(); //untuk auto refresh halaman
                        }
                    }
                })
            })

        })



    </script>
  

@endsection