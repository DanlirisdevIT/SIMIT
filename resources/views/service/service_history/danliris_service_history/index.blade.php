@extends('template.layouts.app')

@section('content')

<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Service History</h2>
                            <!-- <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addAntrianService">
                                Add
                            </button> -->

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Barcode</th>
                                        <th>Pengguna</th>
                                        <th>Barang</th>
                                        <th>Jenis Perbaikan</th>
                                        <th>Alasan Tidak Selesai</th>
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

    <div class="modal fade" id="detailServiceHistory" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Detail Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
    
                    <div class="modal-body" style="overflow:hidden;">
                        <ul id="updateForm_errList"></ul>
                        <input type="hidden" id="id">

                        <div class="form-group">
                            <div class="prioritasForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="serviceForm"></div>
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
                            <div class="danlirisHistoryForm"></div>
                        </div>

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

                        <div class="form-group">
                            <div class="namaTeknisiForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="finalDateLeftForm"></div>
                        </div>
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
                ajax: "{{ route('danliris_service_history.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'date', name: 'date', width: '15%' },
                    {data: 'danliris_histories.barcode', name: 'danliris_histories.barcode', width: '15%'},
                    {data: 'username', name: 'username', width: '15%'},
                    {data: 'asset_name', name: 'asset_name', width: '15%'},
                    {data: 'jenis_kerusakan', name: 'jenis_kerusakan', width: '15%'},
                    {data: 'tindakan_perbaikan', name: 'tindakan_perbaikan', width: '15%'},
                    {data: 'action', name: 'action', width: '20%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        })

        //detail button
        $(document).on('click', '.detail', function() {
            var id = $(this).data('id');

            $('#detailServiceHistory').modal('show');

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('danliris_service_history.index') }}" + '/' + id + "/edit",
                success: function (response) {
                    if (response.status == 200) 
                    {
                        tanggal_datang = '<label name="date_come" class="col-sm-4 control-label"> IP Address </label>';
                        tanggal_datang = tanggal_datang + '<div class="col-sm-12">';
                        tanggal_datang = tanggal_datang + '<input type="text" class="form-control" id="date_come" name="date_come" value="'+response.danliris_antrianservices.date+'" readonly>';
                        tanggal_datang = tanggal_datang + '</div>';

                        tanggal_keluar = '<label name="date_left" class="col-sm-4 control-label"> Tanggal Keluar </label>';
                        tanggal_keluar = tanggal_keluar + '<div class="col-sm-12">';
                        tanggal_keluar = tanggal_keluar + '<input type="text" class="form-control" id="date_left" name="date_left" value="'+response.danliris_antrianservices.date_left+'" maxlength="50" readonly>';
                        tanggal_keluar = tanggal_keluar + '</div>';

                        service = '<label name="status" class="col-sm-4 control-label"> Status Service </label>';
                        service = service + '<div class="col-sm-12">';
                        service = service + '<input type="text" class="form-control" id="status" name="status" value="'+response.danliris_antrianservices.status+'" maxlength="50" readonly>';
                        service = service + '</div>';

                        prioritas = '<label name="prioritas" class="col-sm-4 control-label"> Prioritas </label>';
                        prioritas = prioritas + '<div class="col-sm-12">';
                        prioritas = prioritas + '<input type="text" class="form-control" id="prioritas" name="prioritas" value="'+response.danliris_antrianservices.prioritas+'" maxlength="50" readonly>';
                        prioritas = prioritas + '</div>';
                        
                        time_remaining = '<label name="time_remaining" class="col-sm-4 control-label"> Time Remaining </label>';
                        time_remaining = time_remaining + '<div class="col-sm-12">';
                        time_remaining = time_remaining + '<input type="text" class="form-control" id="time_remaining" name="time_remaining" value="'+(response.danliris_antrianservices.danliris_history_id = 3 ? '3 hari' : '3 Bulan')+'" maxlength="50" readonly>';
                        time_remaining = time_remaining + '</div>';

                        danliris_histories = '<label name="danliris_history_id" class="col-sm-4 control-label"> Barcode </label>';
                        danliris_histories = danliris_histories + '<div class="col-sm-12">';
                        danliris_histories = danliris_histories + '<input type="text" class="form-control" id="danliris_history_id" name="danliris_history_id" value="'+response.danliris_histories.barcode+'" maxlength="50" readonly>';
                        danliris_histories = danliris_histories + '</div>';

                        username = '<label name="username" class="col-sm-4 control-label"> Username </label>';
                        username = username + '<div class="col-sm-12">';
                        username = username + '<input type="text" class="form-control" id="username" name="username" value="'+response.danliris_antrianservices.username+'" maxlength="50" readonly>';
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
                        asset_ip = asset_ip + '<input type="" class="form-control" id="asset_ip" name="asset_ip" value='+(response.danliris_histories.asset_ip = '' ? '' : response.danliris_histories.asset_ip)+'  readonly>';
                        asset_ip = asset_ip + '</div>';

                        nama_teknisi = '<label name="nama_teknisi" class="col-sm-4 control-label"> Nama Teknisi </label>';
                        nama_teknisi = nama_teknisi + '<div class="col-sm-12">';
                        nama_teknisi = nama_teknisi + '<input type="" class="form-control" id="nama_teknisi" name="nama_teknisi" value='+response.danliris_antrianservices.nama_teknisi+'  readonly>';
                        nama_teknisi = nama_teknisi + '</div>';
                        
                        final_date = '<label name="final_date" class="col-sm-8 control-label"> Tanggal Keluar Final </label>';
                        final_date = final_date + '<div class="col-sm-12">';
                        final_date = final_date + '<input type="text" class="form-control" id="final_date" name="date_come" value="'+(response.danliris_antrianservices.date = '' ? '' : response.danliris_antrianservices.date)+'" readonly>';
                        final_date = final_date + '</div>';

                        var show_tanggalkeluar = $('.dateLeftForm').html(tanggal_keluar);
                        var show_tanggaldatang = $('.dateComeForm').html(tanggal_datang);
                        var showForm_barcodeForm = $('.danlirisHistoryForm').html(danliris_histories);
                        var showForm_timeRemainingForm = $('.addedForm').html(time_remaining);
                        var showForm_serviceForm = $('.serviceForm').html(service);
                        var showForm_prioritasForm = $('.prioritasForm').html(prioritas);
                        var showForm_unitForm = $('.unitForm').html(unit);
                        var showForm_divisiForm = $('.divisiForm').html(divisi);
                        var showForm_username = $('.usernameForm').html(username);
                        var showForm_assetip = $('.assetipForm').html(asset_ip);
                        var showForm_assetname = $('.barangForm').html(asset_name);
                        var showForm_finalDate = $('.finalDateLeftForm').html(final_date);
                        var showForm_namaTeknisi = $('.namaTeknisiForm').html(nama_teknisi);
                        
                        show_tanggaldatang.show();
                        show_tanggalkeluar.show();
                        showForm_timeRemainingForm.show();
                        showForm_serviceForm.show();
                        showForm_prioritasForm.show();
                        showForm_assetname.show();
                        showForm_barcodeForm.show();
                        showForm_assetname.show();
                        showForm_unitForm.show();
                        showForm_divisiForm.show();
                        showForm_username.show();
                        showForm_assetip.show();
                        showForm_finalDate.show();
                        showForm_namaTeknisi.show();
                    }
                    else
                    {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.detailAntrianService').modal('hide');                        
                    }
                }
            });
        })

    </script>

@endsection