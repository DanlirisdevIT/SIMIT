@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Pengeluaran</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addPengeluaran">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Tipe Pemasukan</th>
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Barcode</th>
                                        <th>ID Barang / No Seri</th>
                                        <th>Jumlah</th>
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

    <div class="modal fade" id="addPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <ul id="saveForm_errList"></ul>
                    <div class="form-group">
                        <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                        <div class="input-group mb-2">
                            <input type="date" class="form-control" id="date" name="date" aria-label="date" aria-describedby="basic-addon1">
                            {{-- <div class="input-group-prepend">
                                <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                            </div> --}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="pengeluaran_type" class="col-sm-4 control-label"> Tipe Pengeluaran </label>
                        <select class="form-control" id="pengeluaran_type" name="pengeluaran_type">
                            <option value=""> -- Pilih Tipe Pengeluaran -- </option>
                            <option value="from permintaan"> Untuk User dari Permintaan </option>
                            <option value="from it stock"> Untuk user dari IT Stock </option>
                            <option value="to aval"> Ke Aval </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="permintaanForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="kategoriBarangForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="namaBarangForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="barcodeForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="assetipForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="deskripsiForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="quantityForm"></div>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                    <button type="button" class="btn btn-primary create">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updatePengeluaran" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="updatePengeluaranForm" name="updatePengeluaranForm" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="overflow:hidden;">
                        <ul id="updateForm_errList"></ul>
                        <input type="hidden" id="id">

                        <div class="form-group">
                            <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                            <div class="input-group mb-2">
                                <input type="date" class="form-control" id="date" name="date" value={{ old('date', date('Y-m-d')) }} aria-label="date" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="pengeluaranForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="permintaanForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="namaBarangForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="kategoriBarangForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="barcodeForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="assetipForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="quantityForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="deskripsiForm"></div>
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
                    </div>

                </form>
                <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                    <button type="button" class="btn btn-primary update">Perbaharui</button>
                    <button type="button" class="btn btn-danger deletePengeluaran"><i class="far fa-trash-alt"></i></button>
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
                ajax: "{{ route('efrata_pengeluaran.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'date', name: 'date', width: '15%'},
                    {data: 'pengeluaran_type', name: 'pengeluaran_type', width: '15%'},
                    // {data: 'status', name: 'status', width: '15%'},
                    {data: 'category_type', name: 'category_type', width: '15%'},
                    {data: 'category_name', name: 'category_name', width: '15%'},
                    {data: 'barcode', name: 'barcode', width: '15%'},
                    {data: 'asset_ip', name: 'asset_ip', width: '15%'},
                    {data: 'quantity', name: 'quantity', width: '15%'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        });

        //js create form
        $(document).ready(function () {

            $('#pengeluaran_type').on('change', function() {
                var pengeluaran_type = $('#pengeluaran_type').val();

                asset_ip = '<label name="asset_ip" class="col-sm-4 control-label"> IP Address </label>';
                asset_ip = asset_ip + '<div class="col-sm-12">';
                asset_ip = asset_ip + '<input type="number" class="form-control" id="asset_ip" name="asset_ip" placeholder="Masukkan ID Barang / no seri..." maxlength="50" required>';
                asset_ip = asset_ip + '</div>';

                quantity = '<label name="quantity" class="col-sm-4 control-label"> Jumlah </label>';
                quantity = quantity + '<div class="col-sm-12">';
                quantity = quantity + '<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah..." maxlength="50" required>';
                quantity = quantity + '</div>';

                description = '<label name="description" class="col-sm-4 control-label"> Deskripsi </label>';
                description = description + '<div class="col-sm-12">';
                description = description + '<textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50"></textarea>';
                description = description + '</div>';

                if(pengeluaran_type == 'from permintaan')
                {
                    function fetchPemasukan(){
                    $.ajax({
                            type: "GET",
                            url: "{{ route('getPemasukan_ef') }}",
                            dataType: "json",
                            success: function(response)
                            {
                                if(response.status == 200)
                                {
                                    dropdown = '<label name="efrata_pemasukan_id" class="col-sm-4 control-label"> Pemasukan UID </label>';
                                    dropdown = dropdown + '<select class="form-control" id="efrata_pemasukan_id" name="efrata_pemasukan_id">';
                                    dropdown = dropdown + '<option value=""> --- Pilih Pemasukan --- </option>';
                                    dropdown = dropdown + '</select>';

                                    var showForm = $('.permintaanForm').html(dropdown);

                                    showForm.show();

                                    $.each(response.efrata_pemasukans_1, function(index, pemasukan) {
                                        $('select[name="efrata_pemasukan_id"]').append('<option value="'+pemasukan.id+'">'+pemasukan.ef_uid+'</option>')
                                    })

                                    //do 'input' js event
                                    $('#efrata_pemasukan_id').on('input', function() {
                                        var efrata_pemasukan_id = $('#efrata_pemasukan_id').val()

                                        usePemasukan(efrata_pemasukan_id)
                                    })
                                }
                            }
                        });
                    }

                    fetchPemasukan();

                    function usePemasukan(efrata_pemasukan_id){
                        $('#efrata_pemasukan_id').on('change', function() {
                                $.ajax({
                                type: "GET",
                                url: "{{ route('efrata_pengeluaran.create') }}",
                                data:  {'efrata_pemasukan_id' : efrata_pemasukan_id},
                                dataType: "json",
                                beforeSend : function()
                                {
                                    console.log(efrata_pemasukan_id);
                                },
                                success: function(response)
                                {
                                    if(response.status == 200)
                                    {
                                        // var username = response.getUser.username ? response.getUser.username : " ";
                                        // var unit = response.getUnit.unit_name ? response.getUnit.unit_name : " ";

                                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                                        category_type = category_type + '<div class="col-sm-12">';
                                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.efrata_pemasukan.category_type+'" maxlength="50" readonly>';
                                        category_type = category_type + '</div>';

                                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                        category_name = category_name + '<div class="col-sm-12">';
                                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.efrata_pemasukan.category_name+'" maxlength="50" readonly>';
                                        category_name = category_name + '</div>';

                                        barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                                        barcode = barcode + '<div class="col-sm-12">';
                                        barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="'+response.efrata_pemasukan.barcode+'" maxlength="50" readonly>';
                                        barcode = barcode + '</div>';

                                        permintaan_user = '<label name="username" class="col-sm-4 control-label"> User Penerima </label>';
                                        permintaan_user = permintaan_user + '<div class="col-sm-12">';
                                        permintaan_user = permintaan_user + '<input type="text" class="form-control" id="username" name="username" value="" placeholder="Masukkan nama user penerima..." maxlength="50">';
                                        permintaan_user = permintaan_user + '</div>';

                                        unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                                        unit = unit + '<div class="col-sm-12">';
                                        unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value="'+response.getUnit.unit_name+'" maxlength="50" readonly>';
                                        unit = unit + '</div>';

                                        divisi = '<label name="division_name" class="col-sm-4 control-label"> Divisi </label>';
                                        divisi = divisi + '<div class="col-sm-12">';
                                        divisi = divisi + '<input type="text" class="form-control" id="division_name" name="division_name" value="'+response.getDivisi.division_name+'" maxlength="50" readonly>';
                                        divisi = divisi + '</div>';

                                        var showForm_cat_type = $('.kategoriBarangForm').html(category_type);
                                        var showForm_cat_name = $('.namaBarangForm').html(category_name);
                                        var showForm_barcode = $('.barcodeForm').html(barcode);
                                        var showForm_ip = $('.assetipForm').html(asset_ip);
                                        var showForm_quantity = $('.quantityForm').html(quantity);
                                        var showForm_desc = $('.deskripsiForm').html(description);
                                        var showForm_user = $('.usernameForm').html(permintaan_user);
                                        var showForm_unit = $('.unitForm').html(unit);
                                        var showForm_divisi = $('.divisiForm').html(divisi);

                                        showForm_cat_type.show();
                                        showForm_cat_name.show();
                                        showForm_barcode.show();
                                        showForm_ip.show();
                                        showForm_quantity.hide();
                                        showForm_desc.show();
                                        showForm_user.show();
                                        showForm_unit.show();
                                        showForm_divisi.show();

                                    }
                                }
                            })
                        })
                    }
                }
                else if(pengeluaran_type == "from it stock")
                {

                    function fetchPemasukan_2()
                    {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('getPemasukan_ef') }}",
                            dataType: "json",
                            success: function(response)
                            {
                                if(response.status == 200)
                                {
                                    dropdown = '<label name="efrata_pemasukan_id" class="col-sm-4 control-label"> Pemasukan UID </label>';
                                    dropdown = dropdown + '<select class="form-control" id="efrata_pemasukan_id" name="efrata_pemasukan_id">';
                                    dropdown = dropdown + '<option value=""> --- Pilih Pemasukan --- </option>';
                                    dropdown = dropdown + '</select>';

                                    var showForm = $('.permintaanForm').html(dropdown);

                                    showForm.show();

                                    $.each(response.efrata_pemasukans_2, function(index, pemasukan) {
                                        $('select[name="efrata_pemasukan_id"]').append('<option value="'+pemasukan.id+'">'+pemasukan.ef_uid+'</option>')
                                    })

                                    //do 'input' js event
                                    $('#efrata_pemasukan_id').on('input', function() {
                                        var efrata_pemasukan_id = $('#efrata_pemasukan_id').val()

                                        usePemasukan_2(efrata_pemasukan_id)
                                    })
                                }
                            }
                        })
                    }

                    fetchPemasukan_2();

                    function usePemasukan_2(efrata_pemasukan_id){
                        $('#efrata_pemasukan_id').on('change', function() {
                                $.ajax({
                                type: "GET",
                                url: "{{ route('efrata_pengeluaran.create') }}",
                                data:  {'efrata_pemasukan_id' : efrata_pemasukan_id},
                                dataType: "json",
                                beforeSend : function()
                                {
                                    console.log(efrata_pemasukan_id);
                                },
                                success: function(response)
                                {
                                    if(response.status == 200)
                                    {
                                        // var username = response.getUser.username ? response.getUser.username : " ";
                                        // var unit = response.getUnit.unit_name ? response.getUnit.unit_name : " ";

                                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                                        category_type = category_type + '<div class="col-sm-12">';
                                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.efrata_pemasukan.category_type+'" maxlength="50" readonly>';
                                        category_type = category_type + '</div>';

                                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                        category_name = category_name + '<div class="col-sm-12">';
                                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.efrata_pemasukan.category_name+'" maxlength="50" readonly>';
                                        category_name = category_name + '</div>';

                                        barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                                        barcode = barcode + '<div class="col-sm-12">';
                                        barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="'+response.efrata_pemasukan.barcode+'" maxlength="50" readonly>';
                                        barcode = barcode + '</div>';

                                        permintaan_user = '<label name="username" class="col-sm-4 control-label"> User Penerima </label>';
                                        permintaan_user = permintaan_user + '<div class="col-sm-12">';
                                        permintaan_user = permintaan_user + '<input type="text" class="form-control" id="username" name="username" value="" placeholder="Masukkan nama user penerima..." maxlength="50">';
                                        permintaan_user = permintaan_user + '</div>';

                                        unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                                        unit = unit + '<div class="col-sm-12">';
                                        unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value="'+response.getUnit.unit_name+'" maxlength="50" readonly>';
                                        unit = unit + '</div>';

                                        divisi = '<label name="division_name" class="col-sm-4 control-label"> Divisi </label>';
                                        divisi = divisi + '<div class="col-sm-12">';
                                        divisi = divisi + '<input type="text" class="form-control" id="division_name" name="division_name" value="'+response.getDivisi.division_name+'" maxlength="50" readonly>';
                                        divisi = divisi + '</div>';

                                        var showForm_cat_type = $('.kategoriBarangForm').html(category_type);
                                        var showForm_cat_name = $('.namaBarangForm').html(category_name);
                                        var showForm_barcode = $('.barcodeForm').html(barcode);
                                        var showForm_ip = $('.assetipForm').html(asset_ip);
                                        var showForm_quantity = $('.quantityForm').html(quantity);
                                        var showForm_desc = $('.deskripsiForm').html(description);
                                        var showForm_user = $('.usernameForm').html(permintaan_user);
                                        var showForm_unit = $('.unitForm').html(unit);
                                        var showForm_divisi = $('.divisiForm').html(divisi);

                                        showForm_cat_type.show();
                                        showForm_cat_name.show();
                                        showForm_barcode.show();
                                        showForm_ip.show();
                                        showForm_quantity.show();
                                        showForm_desc.show();
                                        showForm_user.show();
                                        showForm_unit.show();
                                        showForm_divisi.show();
                                    }
                                }
                            })
                        })
                    }
                }
                else if(pengeluaran_type == "to aval")
                {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getBarang_ef') }}",
                        dataType: "json",
                        success: function(response)
                        {
                            if(response.status == 200)
                            {
                                category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                                category_type = category_type + '<select class="form-control" id="category_type" name="category_type">';
                                category_type = category_type + '<option value=""> --- Pilih Kategori Barang --- </option>';
                                category_type = category_type + '</select>';

                                category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                category_name = category_name + '<select class="form-control" id="category_name" name="category_name">';
                                category_name = category_name + '<option value=""> --- Pilih Nama Barang --- </option>';
                                category_name = category_name + '</select>';

                                barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                                barcode = barcode + '<div class="col-sm-12">';
                                barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="" maxlength="50" readonly>';
                                barcode = barcode + '</div>';

                                console.log(response.getBarang)
                                $.each(response.getBarang, function(index, barang_type) {
                                    $('select[name="category_type"]').append('<option value="'+barang_type.id+'">'+barang_type.category_id+'</option>')
                                })

                                $.each(response.getBarang, function(index, barang_name) {
                                    $('select[name="category_name"]').append('<option value="'+barang_name.id+'">'+barang_name.asset_name+'</option>')
                                })

                                var showForm_cat_type = $('.kategoriBarangForm').html(category_type);
                                var showForm_cat_name = $('.namaBarangForm').html(category_name);
                                var showForm_barcode = $('.barcodeForm').html(barcode);
                                var showForm_ip = $('.assetipForm').html(asset_ip);
                                // var showForm_quantity = $('.quantityForm').html(quantity);
                                var showForm_desc = $('.deskripsiForm').html(description);
                                // var showForm_user = $('.usernameForm').html(permintaan_user);
                                // var showForm_unit = $('.unitForm').html(unit);
                                // var showForm_divisi = $('.divisiForm').html(divisi);

                                showForm_cat_type.show();
                                showForm_cat_name.show();
                                showForm_barcode.show();
                                showForm_ip.show();
                                // showForm_quantity.hide();
                                showForm_desc.show();
                                // showForm_user.hide();
                                // showForm_unit.hide();
                                // showForm_divisi.hide();

                            }
                        }
                    })
                }
            })

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date': $('#date').val(),
                    'pengeluaran_type': $('#pengeluaran_type').val(),
                    'efrata_pemasukan_id': $('#efrata_pemasukan_id').val(),
                    'category_type': $('#category_type').val(),
                    'category_name': $('#category_name').val(),
                    'barcode': $('#barcode').val(),
                    'asset_ip': $('#asset_ip').val(),
                    'quantity': $('#quantity').val(),
                    'description': $('#description').val(),
                    'username': $('#username').val(),
                    'unit_name': $('#unit_name').val(),
                    'division_name': $('#division_name').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('efrata_pengeluaran.store') }}",
                    dataType: "json",
                    success: function(response)
                    {
                        if(response.status == 400){
                            $('#saveForm_errList').html("");
                            $('#saveForm_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveForm_errList').append('<li>'+err_values+'</li>');
                            });
                        }else if(response.status == 200){
                            $('#saveForm_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.messages);
                            $('#addPengeluaran').modal('hide');
                            $('#addPengeluaran').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                            location.reload()
                        }
                    }
                })
            })
        })

        $(document).on('click', '.editPengeluaran', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#updatePengeluaran').modal('show');

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('efrata_pengeluaran.index') }}" + '/' + id + '/edit',
                dataType: "json",
                success: function (response) {
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editPengeluaran').modal('hide');
                    }
                    else
                    {
                        $('#id').val(id)
                        $('#updatePengeluaran').find('#date').val(response.efrata_pengeluarans.date);
                        $('#updatePengeluaran').find('#pengeluaran_type').val(response.efrata_pengeluarans.pengeluaran_type);

                        // console.log(response.efrata_pemasukans.dl_uid)

                        //form update
                        pengeluaran_type = '<label name="pengeluaran_type" class="col-sm-4 control-label"> Tipe Pengeluaran </label>';
                        pengeluaran_type = pengeluaran_type + '<div class="col-sm-12">';
                        pengeluaran_type = pengeluaran_type + '<input type="text" class="form-control" id="pengeluaran_type" name="pengeluaran_type" value="'+response.efrata_pengeluarans.pengeluaran_type+'" maxlength="50" readonly>';
                        pengeluaran_type = pengeluaran_type + '</div>';

                        dropdown = '<label name="efrata_pemasukan_id" class="col-sm-4 control-label"> Pemasukan UID </label>';
                        dropdown = dropdown + '<select class="form-control" id="efrata_pemasukan_id" name="efrata_pemasukan_id">';
                        dropdown = dropdown + '<option value = "'+response.efrata_pemasukans.id+'" selected> --- '+response.efrata_pemasukans.ef_uid+' --- </option>';
                        dropdown = dropdown + '</select>';

                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                        category_type = category_type + '<div class="col-sm-12">';
                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.efrata_pengeluarans.category_type+'" maxlength="50" readonly>';
                        category_type = category_type + '</div>';

                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                        category_name = category_name + '<div class="col-sm-12">';
                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.efrata_pengeluarans.category_name+'" maxlength="50" readonly>';
                        category_name = category_name + '</div>';

                        barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                        barcode = barcode + '<div class="col-sm-12">';
                        barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="'+response.efrata_pengeluarans.barcode+'" maxlength="50" readonly>';
                        barcode = barcode + '</div>';

                        permintaan_user = '<label name="username" class="col-sm-4 control-label"> User Penerima </label>';
                        permintaan_user = permintaan_user + '<div class="col-sm-12">';
                        permintaan_user = permintaan_user + '<input type="text" class="form-control" id="username" name="username" value="'+response.efrata_pengeluarans.username+'" maxlength="50">';
                        permintaan_user = permintaan_user + '</div>';

                        asset_ip = '<label name="asset_ip" class="col-sm-4 control-label"> IP Address </label>';
                        asset_ip = asset_ip + '<div class="col-sm-12">';
                        asset_ip = asset_ip + '<input type="" class="form-control" id="asset_ip" name="asset_ip" value='+response.efrata_pengeluarans.asset_ip+' maxlength="50" required>';
                        asset_ip = asset_ip + '</div>';

                        if(!response.efrata_pengeluarans.quantity)
                        {
                            quantity = '<label name="quantity" class="col-sm-4 control-label"> Jumlah </label>';
                            quantity = quantity + '<div class="col-sm-12">';
                            quantity = quantity + '<input type="number" class="form-control" id="quantity" name="quantity" value=" " maxlength="50" required>';
                            quantity = quantity + '</div>';
                        }
                        else
                        {
                            quantity = '<label name="quantity" class="col-sm-4 control-label"> Jumlah </label>';
                            quantity = quantity + '<div class="col-sm-12">';
                            quantity = quantity + '<input type="number" class="form-control" id="quantity" name="quantity" value='+response.efrata_pengeluarans.quantity+' maxlength="50" required>';
                            quantity = quantity + '</div>';
                        }


                        if(!response.efrata_pengeluarans.description)
                        {
                            description = '<label name="description" class="col-sm-4 control-label"> Deskripsi </label>';
                            description = description + '<div class="col-sm-12">';
                            description = description + '<textarea type="text" class="form-control" id="description" name="description" value='+response.efrata_pengeluarans.description+' maxlength="50"></textarea>';
                            description = description + '</div>';
                        }
                        else
                        {
                            description = '<label name="description" class="col-sm-4 control-label"> Deskripsi </label>';
                            description = description + '<div class="col-sm-12">';
                            description = description + '<textarea type="text" class="form-control" id="description" name="description" value='+response.efrata_pengeluarans.description+' maxlength="50">'+response.efrata_pengeluarans.description+'</textarea>';
                            description = description + '</div>';
                        }

                        unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                        unit = unit + '<div class="col-sm-12">';
                        unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value="'+response.efrata_pengeluarans.unit_name+'" maxlength="50" readonly>';
                        unit = unit + '</div>';

                        divisi = '<label name="division_name" class="col-sm-4 control-label"> Divisi </label>';
                        divisi = divisi + '<div class="col-sm-12">';
                        divisi = divisi + '<input type="text" class="form-control" id="division_name" name="division_name" value="'+response.efrata_pengeluarans.division_name+'" maxlength="50" readonly>';
                        divisi = divisi + '</div>';

                        var showForm = $('.pengeluaranForm').html(pengeluaran_type);
                        var showForm_pemasukan_uid = $('.permintaanForm').html(dropdown);
                        var showForm_cat_type = $('.kategoriBarangForm').html(category_type);
                        var showForm_cat_name = $('.namaBarangForm').html(category_name);
                        var showForm_barcode = $('.barcodeForm').html(barcode);
                        var showForm_ip = $('.assetipForm').html(asset_ip);
                        var showForm_quantity = $('.quantityForm').html(quantity);
                        var showForm_desc = $('.deskripsiForm').html(description);
                        var showForm_user = $('.usernameForm').html(permintaan_user);
                        var showForm_unit = $('.unitForm').html(unit);
                        var showForm_divisi = $('.divisiForm').html(divisi);

                        if(response.efrata_pengeluarans.pengeluaran_type == "from permintaan")
                        {
                            showForm.show()
                            showForm_pemasukan_uid.show()
                            showForm_cat_type.show();
                            showForm_cat_name.show();
                            showForm_barcode.show();
                            showForm_ip.show();
                            showForm_quantity.hide();
                            showForm_desc.show();
                            showForm_user.show();
                            showForm_unit.show();
                            showForm_divisi.show();
                        }
                        else if(response.efrata_pengeluarans.pengeluaran_type == "to aval")
                        {
                            showForm_cat_type.show();
                            showForm_cat_name.show();
                            showForm_barcode.show();
                            showForm_ip.show();
                            showForm_desc.show();
                        }
                    }
                }
            })
        })

        $(document).on('click', '.update', function(e) {
            e.preventDefault();

            $(this).text('Memperbaharui');

            var id = $('#id').val();

            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = {
                date: $('#updatePengeluaranForm').find('#date').val(),
                pengeluaran_type: $('#updatePengeluaranForm').find('#pengeluaran_type').val(),
                efrata_pemasukan_id: $('#updatePengeluaranForm').find('#efrata_pemasukan_id').val(),
                category_type: $('#updatePengeluaranForm').find('#category_type').val(),
                category_name: $('#updatePengeluaranForm').find('#category_name').val(),
                barcode: $('#updatePengeluaranForm').find('#barcode').val(),
                asset_ip: $('#updatePengeluaranForm').find('#asset_ip').val(),
                quantity: $('#updatePengeluaranForm').find('#quantity').val(),
                description: $('#updatePengeluaranForm').find('#description').val(),
                username: $('#updatePengeluaranForm').find('#username').val(),
                unit_name: $('#updatePengeluaranForm').find('#unit_name').val(),
                division_name: $('#updatePengeluaranForm').find('#division_name').val(),
            }

            $.ajax({
                url: "/efrata_pengeluaran/" + id,
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
                        $('#updatePengeluaran').find('input').val('');
                        $('.update').text('update');
                        $('#updatePengeluaran').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload()
                    }
                }
            })
        })

        //js delete
        $(document).on('click', '.deletePengeluaran', function() {
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
                    url: "efrata_pengeluaran/" + id,
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
                            $('#updatePengeluaran').modal('hide')
                            var table = $('.datatables').DataTable()
                            table.ajax.reload()
                            location.reload()
                        }
                    }
                })
            })
        })
        //end js delete


    </script>

@endsection
