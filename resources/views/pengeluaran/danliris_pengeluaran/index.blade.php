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
                                        <th>Tipe Pengeluaran</th>
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Barcode</th>
                                        <th>IP</th>
                                        {{-- <th>Jumlah</th> --}}
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
                        <div class="namaKategoriForm"></div>
                    </div>

                    <div class="form-group">
                        <div class="tipeKategoriForm"></div>
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

                    {{-- <div class="form-group">
                        <div class="quantityForm"></div>
                    </div> --}}

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

                        <!-- <div class="form-group">
                            <div class="permintaanForm"></div>
                        </div>

                        {{-- <div class="form-group pemasukan">
                            <label name="danliris_pemasukan_id" class="col-sm-4 control-label"> Pemasukan </label>
                            <select class="form-control" id="danliris_pemasukan_id" name="danliris_pemasukan_id">
                                <option value=""> -- Pilih Barcode -- </option>
                                @foreach ($danliris_pemasukans as $pemasukan)
                                    <option value="{{ $pemasukan->id }}"> {{ $pemasukan->barcode}} </option>
                                @endforeach
                            </select>
                        </div> --}} -->

                        <div class="form-group">
                            <div class="namaKategoriForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="tipeKategoriForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="namaBarangForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="barcodeForm"></div>
                        </div>

                        <div class="form-group">
                            <select class="form-control" id="type_barcode" name="type_barcode">
                                <option value=''>Pilih Jenis Barcode</option>
                                <option value='CODE128'>CODE128</option>
                                <option value='CODE39'>CODE39</option>
                                <option value='EAN-13'>EAN-13</option>
                                <option value='EAN-8'>EAN-8</option>
                                <option value='EAN-5'>EAN-5</option>
                                <option value='EAN-2'>EAN-2</option>
                                <option value='UPC (A)'>UPC (A)</option>
                                <option value='ITF-14'>ITF-14</option>
                                <option value='ITF'>ITF</option>
                                <option value='MSI'>MSI</option>
                                <option value='MSI10'>MSI10</option>
                                <option value='MSI11'>MSI11</option>
                                <option value='MSI1010'>MSI1010</option>
                                <option value='MSI1110'>MSI1110</option>
                                <option value='Pharmacode'>Pharmacode</option>
                                <option value='Codabar'>Codabar</option>
                            </select>
                            <div class="text-center" id="print_barcode" style="padding: 10px; border: 1px solid #000;">
                                <img id="get_barcode"/>
                            </div>
                            <div id="ignored"></div>
                            <button class="btn btn-outline-primary" id="printBarcode"> Cetak </button>
                        </div>

                        <div class="form-group">
                            <div class="assetipForm"></div>
                        </div>

                        {{-- <div class="form-group">
                            <div class="quantityForm"></div>
                        </div> --}}

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
                ajax: "{{ route('danliris_pengeluaran.index') }}",
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
                    // {data: 'quantity', name: 'quantity', width: '15%'},
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
                // var pengeluaran_type = $('#pengeluaran_type').val();
                // quantity = '<label name="quantity" class="col-sm-4 control-label"> Jumlah </label>';
                // quantity = quantity + '<div class="col-sm-12">';
                // quantity = quantity + '<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah..."  required>';
                // quantity = quantity + '</div>';

                asset_ip = '<label name="asset_ip" class="col-sm-4 control-label"> IP Address </label>';
                asset_ip = asset_ip + '<div class="col-sm-12">';
                asset_ip = asset_ip + '<input type="text" class="form-control" id="asset_ip" name="asset_ip" placeholder="Masukkan ID Barang / no seri..."  required>';
                asset_ip = asset_ip + '</div>';

                description = '<label name="description" class="col-sm-4 control-label"> Deskripsi </label>';
                description = description + '<div class="col-sm-12">';
                description = description + '<textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  ></textarea>';
                description = description + '</div>';

                if(this.value == 'from permintaan')
                {
                    function fetchPemasukan(){
                       $.ajax({
                            type: "GET",
                            url: "{{ route('getPemasukan_dl') }}",
                            dataType: "json",
                            success: function(response)
                            {
                                if(response.status == 200)
                                {
                                    dropdown = '<label name="danliris_pemasukan_id" class="col-sm-4 control-label"> Barcode </label>';
                                    dropdown = dropdown + '<select class="form-control" id="danliris_pemasukan_id" name="danliris_pemasukan_id">';
                                    dropdown = dropdown + '<option value=""> --- Pilih Barcode --- </option>';
                                    dropdown = dropdown + '</select>';

                                    var showForm = $('.permintaanForm').html(dropdown);

                                    showForm.show();

                                    $.each(response.danliris_pemasukans_1, function(index, pemasukan) {
                                        $('select[name="danliris_pemasukan_id"]').append('<option value="'+pemasukan.id+'">'+pemasukan.barcode+'</option>')
                                    })

                                    //do 'input' js event
                                    $('#danliris_pemasukan_id').on('input', function() {
                                        var danliris_pemasukan_id = $('#danliris_pemasukan_id').val()

                                        usePemasukan(danliris_pemasukan_id)
                                    })
                                }
                            }
                        });
                    }

                    fetchPemasukan();

                    function usePemasukan(danliris_pemasukan_id){
                        $('#danliris_pemasukan_id').on('change', function() {
                                $.ajax({
                                type: "GET",
                                url: "{{ route('danliris_pengeluaran.create') }}",
                                data:  {'danliris_pemasukan_id' : danliris_pemasukan_id},
                                dataType: "json",
                                beforeSend : function()
                                {
                                    console.log(danliris_pemasukan_id);
                                },
                                success: function(response)
                                {
                                    if(response.status == 200)
                                    {
                                        // var username = response.getUser.username ? response.getUser.username : " ";
                                        // var unit = response.getUnit.unit_name ? response.getUnit.unit_name : " ";

                                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                                        category_type = category_type + '<div class="col-sm-12">';
                                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.danliris_pemasukan.category_type+'"  readonly>';
                                        category_type = category_type + '</div>';

                                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                        category_name = category_name + '<div class="col-sm-12">';
                                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.danliris_pemasukan.category_name+'"  readonly>';
                                        category_name = category_name + '</div>';

                                        asset_name = '<label name="asset_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                        asset_name = asset_name + '<div class="col-sm-12">';
                                        asset_name = asset_name + '<input type="text" class="form-control" id="asset_name" name="asset_name" value="'+response.danliris_pemasukan.asset_name+'"  readonly>';
                                        asset_name = asset_name + '</div>';

                                        // barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                                        // barcode = barcode + '<div class="col-sm-12">';
                                        // barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="'+response.danliris_pemasukan.barcode+'"  readonly>';
                                        // barcode = barcode + '</div>';

                                        permintaan_user = '<label name="username" class="col-sm-4 control-label"> User Penerima </label>';
                                        permintaan_user = permintaan_user + '<div class="col-sm-12">';
                                        permintaan_user = permintaan_user + '<input type="text" class="form-control" id="username" name="username" value="" placeholder="Masukkan nama user penerima..." >';
                                        permintaan_user = permintaan_user + '</div>';

                                        // unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                                        // unit = unit + '<div class="col-sm-12">';
                                        // unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value="'+response.getUnit.unit_name+'"  readonly>';
                                        // unit = unit + '</div>';

                                        unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                                        unit = unit + '<select class="form-control" id="unit_name" name="unit_name">';
                                        unit = unit + '</select>';

                                        divisi = '<label name="unit_name" class="col-sm-4 control-label"> Divisi </label>';
                                        divisi = divisi + '<select class="form-control" id="division_name" name="division_name">';
                                        divisi = divisi + '</select>';

                                        var showForm_cat_type = $('.tipeKategoriForm').html(category_type);
                                        var showForm_ast_name = $('.namaBarangForm').html(asset_name);
                                        var showForm_cat_name = $('.namaKategoriForm').html(category_name);
                                        // var showForm_barcode = $('.barcodeForm').html(barcode);
                                        var showForm_ip = $('.assetipForm').html(asset_ip);
                                        // var showForm_quantity = $('.quantityForm').html(quantity);
                                        var showForm_desc = $('.deskripsiForm').html(description);
                                        var showForm_user = $('.usernameForm').html(permintaan_user);
                                        var showForm_unit = $('.unitForm').html(unit);
                                        var showForm_divisi = $('.divisiForm').html(divisi);

                                        $.each(response.getUnit, function(index, unit) {
                                            $('select[name="unit_name"]').append('<option value="'+unit.unit_name+'">'+unit.unit_name+'</option>');
                                        })
                                        
                                        $.each(response.getDivisi, function(index, divisions) {
                                            $('select[name="division_name"]').append('<option value="'+divisions.division_name+'">'+divisions.division_name+'</option>');
                                        })

                                        if(response.danliris_pemasukan.category_name == 'Laptop' || response.danliris_pemasukan.category_name == 'Laptop' || response.danliris_pemasukan.category_name == 'Printer')
                                        {
                                            showForm_cat_type.show();
                                            showForm_cat_name.show();
                                            showForm_ast_name.show();
                                            // showForm_barcode.show();
                                            showForm_ip.show();
                                            // showForm_quantity.hide();
                                            showForm_desc.show();
                                            showForm_user.show();
                                            showForm_unit.show();
                                            showForm_divisi.show();
                                        }
                                        else
                                        {
                                            showForm_ip.hide();
                                        }

                                    }
                                }
                            })
                        })
                    }
                }
                else if(this.value == "from it stock")
                {

                    function fetchPemasukan_2()
                    {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('getPemasukan_dl') }}",
                            dataType: "json",
                            success: function(response)
                            {
                                if(response.status == 200)
                                {
                                    dropdown = '<label name="danliris_pemasukan_id" class="col-sm-4 control-label"> Barcode </label>';
                                    dropdown = dropdown + '<select class="form-control" id="danliris_pemasukan_id" name="danliris_pemasukan_id">';
                                    dropdown = dropdown + '<option value=""> --- Pilih Pemasukan --- </option>';
                                    dropdown = dropdown + '</select>';

                                    var showForm = $('.permintaanForm').html(dropdown);

                                    showForm.show();

                                    $.each(response.danliris_pemasukans_2, function(index, pemasukan) {
                                        $('select[name="danliris_pemasukan_id"]').append('<option value="'+pemasukan.id+'">'+pemasukan.barcode+'</option>')
                                    })

                                    //do 'input' js event
                                    $('#danliris_pemasukan_id').on('input', function() {
                                        var danliris_pemasukan_id = $('#danliris_pemasukan_id').val()

                                        usePemasukan_2(danliris_pemasukan_id)
                                    })
                                }
                            }
                        })
                    }

                    fetchPemasukan_2();

                    function usePemasukan_2(danliris_pemasukan_id){
                        $('#danliris_pemasukan_id').on('change', function() {
                                $.ajax({
                                type: "GET",
                                url: "{{ route('danliris_pengeluaran.create') }}",
                                data:  {'danliris_pemasukan_id' : danliris_pemasukan_id},
                                dataType: "json",
                                beforeSend : function()
                                {
                                    console.log(danliris_pemasukan_id);
                                },
                                success: function(response)
                                {
                                    if(response.status == 200)
                                    {
                                        // var username = response.getUser.username ? response.getUser.username : " ";
                                        // var unit = response.getUnit.unit_name ? response.getUnit.unit_name : " ";

                                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                                        category_type = category_type + '<div class="col-sm-12">';
                                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.danliris_pemasukan.category_type+'"  readonly>';
                                        category_type = category_type + '</div>';

                                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                        category_name = category_name + '<div class="col-sm-12">';
                                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.danliris_pemasukan.category_name+'"  readonly>';
                                        category_name = category_name + '</div>';

                                        asset_name = '<label name="asset_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                        asset_name = asset_name + '<div class="col-sm-12">';
                                        asset_name = asset_name + '<input type="text" class="form-control" id="asset_name" name="asset_name" value="'+response.danliris_pemasukan.asset_name+'"  readonly>';
                                        asset_name = asset_name + '</div>';

                                        // barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                                        // barcode = barcode + '<div class="col-sm-12">';
                                        // barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="'+response.danliris_pemasukan.barcode+'"  readonly>';
                                        // barcode = barcode + '</div>';

                                        permintaan_user = '<label name="username" class="col-sm-4 control-label"> User Penerima </label>';
                                        permintaan_user = permintaan_user + '<div class="col-sm-12">';
                                        permintaan_user = permintaan_user + '<input type="text" class="form-control" id="username" name="username" value="" placeholder="Masukkan nama user penerima..." >';
                                        permintaan_user = permintaan_user + '</div>';

                                        unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                                        unit = unit + '<div class="col-sm-12">';
                                        unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value="'+response.getUnit.unit_name+'"  readonly>';
                                        unit = unit + '</div>';

                                        divisi = '<label name="division_name" class="col-sm-4 control-label"> Divisi </label>';
                                        divisi = divisi + '<select class="form-control" id="division_name" name="division_name">';
                                        divisi = divisi + '</select>';

                                        var showForm_cat_type = $('.tipeKategoriForm').html(category_type);
                                        var showForm_cat_name = $('.namaKategoriForm').html(category_name);
                                        var showForm_ast_name = $('.namaBarangForm').html(asset_name);                                        // var showForm_barcode = $('.barcodeForm').html(barcode);
                                        var showForm_ip = $('.assetipForm').html(asset_ip);
                                        // var showForm_quantity = $('.quantityForm').html(quantity);
                                        var showForm_desc = $('.deskripsiForm').html(description);
                                        var showForm_user = $('.usernameForm').html(permintaan_user);
                                        var showForm_unit = $('.unitForm').html(unit);
                                        var showForm_divisi = $('.divisiForm').html(divisi);

                                        $.each(response.getDivisi, function(index, divisions) {
                                            $('select[name="division_name"]').append('<option value="'+divisions.division_name+'">'+divisions.division_name+'</option>');
                                        })
                                        
                                        if(response.danliris_pemasukan.category_name == 'Laptop' || response.danliris_pemasukan.category_name == 'Laptop' || response.danliris_pemasukan.category_name == 'Printer')
                                        {
                                            showForm_cat_type.show();
                                            showForm_cat_name.show();
                                            showForm_ast_name.hide();
                                            // showForm_barcode.show();
                                            showForm_ip.show();
                                            // showForm_quantity.show();
                                            showForm_desc.show();
                                            showForm_user.show();
                                            showForm_unit.show();
                                            showForm_divisi.show();
                                        }
                                        else
                                        {
                                            showForm_ast_name.hide();
                                        }
                                    }
                                }
                            })
                        })
                    }
                }
                else if(this.value == "to aval")
                {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('getBarang_dl') }}",
                        dataType: "json",
                        success: function(response)
                        {
                            if(response.status == 200)
                            {
                                category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                                category_type = category_type + '<select class="form-control" id="category_type" name="category_type">';
                                category_type = category_type + '<option value=""> --- Pilih Tipe Kategori --- </option>';
                                category_type = category_type + '</select>';

                                category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Kategori </label>';
                                category_name = category_name + '<select class="form-control" id="category_name" name="category_name">';
                                category_name = category_name + '<option value=""> --- Pilih Nama Kategori --- </option>';
                                category_name = category_name + '</select>';

                                // asset_name = '<label name="asset_name" class="col-sm-4 control-label"> Nama Barang </label>';
                                // asset_name = asset_name + '<div class="col-sm-12">';
                                // asset_name = asset_name + '<input type="text" class="form-control" id="asset_name" name="asset_name" value="'+response.getBarang.asset_name+'"  readonly>';
                                // asset_name = asset_name + '</div>';

                                // barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                                // barcode = barcode + '<div class="col-sm-12">';
                                // barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value=""  readonly>';
                                // barcode = barcode + '</div>';

                                // permintaan_user = '<label name="username" class="col-sm-4 control-label"> User Penerima </label>';
                                // permintaan_user = permintaan_user + '<div class="col-sm-12">';
                                // permintaan_user = permintaan_user + '<input type="text" class="form-control" id="username" name="username" value="" placeholder="Masukkan nama user penerima..." >';
                                // permintaan_user = permintaan_user + '</div>';

                                // unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                                // unit = unit + '<div class="col-sm-12">';
                                // unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value=""  readonly>';
                                // unit = unit + '</div>';

                                // divisi = '<label name="division_name" class="col-sm-4 control-label"> Divisi </label>';
                                // divisi = divisi + '<select class="form-control" id="division_name" name="division_name">';
                                // divisi = divisi + '</select>';

                                console.log(response.getCategory)
                                $.each(response.getCategory, function(index, category_type) {
                                    $('select[name="category_type"]').append('<option value="'+category_type.id+'">'+category_type.category_type+'</option>')
                                })

                                $.each(response.getCategory, function(index, category_name) {
                                    $('select[name="category_name"]').append('<option value="'+category_name.id+'">'+category_name.category_name+'</option>')
                                })

                                var showForm_cat_type = $('.tipeKategoriForm').html(category_type);
                                var showForm_cat_name = $('.namaKategoriForm').html(category_name);
                                // var showForm_ast_name = $('.namaBarangForm').html(asset_name);
                                // var showForm_barcode = $('.barcodeForm').html(barcode);
                                // var showForm_ip = $('.assetipForm').html(asset_ip);
                                // var showForm_quantity = $('.quantityForm').html(quantity);
                                // var showForm_desc = $('.deskripsiForm').html(description);
                                // var showForm_user = $('.usernameForm').html(permintaan_user);
                                // var showForm_unit = $('.unitForm').html(unit);
                                // var showForm_divisi = $('.divisiForm').html(divisi);

                                $.each(response.getDivisi, function(index, divisions) {
                                    $('select[name="division_name"]').append('<option value="'+divisions.division_name+'">'+divisions.division_name+'</option>');
                                })

                                // if(response.getCategory.category_name == 'Laptop' || response.getCategory.category_name == 'Laptop' || response.getCategory.category_name == 'Printer')
                                // {
                                //     showForm_cat_type.show();
                                //     showForm_cat_name.show();
                                //     showForm_ast_name.show();
                                //     // showForm_barcode.show();
                                //     showForm_ip.show();
                                //     // showForm_quantity.hide();
                                //     showForm_desc.show();
                                //     showForm_user.show();
                                //     showForm_unit.show();
                                //     showForm_divisi.show();
                                // }
                                // else
                                // {
                                //     showForm_ast_name.hide();
                                // }

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
                    'danliris_pemasukan_id': $('#danliris_pemasukan_id').val(),
                    'category_type': $('#category_type').val(),
                    'category_name': $('#category_name').val(),
                    // 'barcode': $('#barcode').val(),
                    'asset_name' : $('#asset_name').val(),
                    'asset_ip': $('#asset_ip').val(),
                    // 'quantity': $('#quantity').val(),
                    'description': $('#description').val(),
                    'username': $('#username').val(),
                    'unit_name': $('#unit_name').val(),
                    'division_name': $('#division_name').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('danliris_pengeluaran.store') }}",
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
        //end js create form

        $(document).on('click', '.editPengeluaran', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#updatePengeluaran').modal('show');

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('danliris_pengeluaran.index') }}" + '/' + id + '/edit',
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
                        $('#updatePengeluaran').find('#date').val(response.danliris_pengeluarans.date);
                        $('#updatePengeluaran').find('#pengeluaran_type').val(response.danliris_pengeluarans.pengeluaran_type);
                        // $('#updatePengeluaran').find('#danliris_pemasukan_id').val(response.danliris_pemasukans.id);
                        // $('#updatePengeluaran').find('#namaKategoriForm').val(response.danliris_pengeluarans.category_name);
                        // $('#updatePengeluaran').find('#kategoriBarangForm').val(response.danliris_pengeluarans.category_type);
                        // $('#updatePengeluaran').find('#barcodeForm').val(response.danliris_pengeluarans.barcode);
                        // $('#updatePengeluaran').find('#assetipForm').val(response.danliris_pengeluarans.asset_ip);
                        // $('#updatePengeluaran').find('#quantityForm').val(response.danliris_pengeluarans.quantity);
                        // $('#updatePengeluaran').find('#deskripsiForm').val(response.danliris_pengeluarans.description);
                        // $('#updatePengeluaran').find('#unitForm').val(response.danliris_pengeluarans.unit_name);
                        // $('#updatePengeluaran').find('#divisiForm').val(response.danliris_pengeluarans.division_name);

                        console.log(response.danliris_pemasukans.dl_uid)
                        
                        var get_nama_barang = response.danliris_pengeluarans.asset_name ? response.danliris_pengeluarans.asset_name : " ";

                        //form update
                        pengeluaran_type = '<label name="pengeluaran_type" class="col-sm-4 control-label"> Tipe Pengeluaran </label>';
                        pengeluaran_type = pengeluaran_type + '<div class="col-sm-12">';
                        pengeluaran_type = pengeluaran_type + '<input type="text" class="form-control" id="pengeluaran_type" name="pengeluaran_type" value="'+response.danliris_pengeluarans.pengeluaran_type+'"  readonly>';
                        pengeluaran_type = pengeluaran_type + '</div>';

                        // dropdown = '<label name="danliris_pemasukan_id" class="col-sm-4 control-label"> Barcode </label>';
                        // dropdown = dropdown + '<select class="form-control" id="danliris_pemasukan_id" name="danliris_pemasukan_id">';
                        // dropdown = dropdown + '<option value = "'+response.danliris_pemasukans.id+'" selected> --- '+response.danliris_pemasukans.barcode+' --- </option>';
                        // dropdown = dropdown + '</select>';

                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                        category_type = category_type + '<div class="col-sm-12">';
                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.danliris_pengeluarans.category_type+'"  readonly>';
                        category_type = category_type + '</div>';

                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                        category_name = category_name + '<div class="col-sm-12">';
                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.danliris_pengeluarans.category_name+'"  readonly>';
                        category_name = category_name + '</div>';

                        asset_name = '<label name="asset_name" class="col-sm-4 control-label"> Nama Barang </label>';
                        asset_name = asset_name + '<div class="col-sm-12">';
                        asset_name = asset_name + '<input type="text" class="form-control" id="asset_name" name="asset_name" value="'+get_nama_barang+'"  readonly>';
                        asset_name = asset_name + '</div>';

                        barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                        barcode = barcode + '<div class="col-sm-12">';
                        barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="'+response.danliris_pengeluarans.barcode+'"  readonly>';
                        barcode = barcode + '</div>';

                        permintaan_user = '<label name="username" class="col-sm-4 control-label"> User Penerima </label>';
                        permintaan_user = permintaan_user + '<div class="col-sm-12">';
                        permintaan_user = permintaan_user + '<input type="text" class="form-control" id="username" name="username" value="'+response.danliris_pengeluarans.username+'" >';
                        permintaan_user = permintaan_user + '</div>';

                        asset_ip = '<label name="asset_ip" class="col-sm-4 control-label"> IP Address </label>';
                        asset_ip = asset_ip + '<div class="col-sm-12">';
                        asset_ip = asset_ip + '<input type="" class="form-control" id="asset_ip" name="asset_ip" value='+response.danliris_pengeluarans.asset_ip+'  required>';
                        asset_ip = asset_ip + '</div>';

                        // if(!response.danliris_pengeluarans.quantity)
                        // {
                        //     quantity = '<label name="quantity" class="col-sm-4 control-label"> Jumlah </label>';
                        //     quantity = quantity + '<div class="col-sm-12">';
                        //     quantity = quantity + '<input type="number" class="form-control" id="quantity" name="quantity" value=" "  required>';
                        //     quantity = quantity + '</div>';
                        // }
                        // else
                        // {
                        //     quantity = '<label name="quantity" class="col-sm-4 control-label"> Jumlah </label>';
                        //     quantity = quantity + '<div class="col-sm-12">';
                        //     quantity = quantity + '<input type="number" class="form-control" id="quantity" name="quantity" value='+response.danliris_pengeluarans.quantity+'  required>';
                        //     quantity = quantity + '</div>';
                        // }


                        if(!response.danliris_pengeluarans.description)
                        {
                            description = '<label name="description" class="col-sm-4 control-label"> Deskripsi </label>';
                            description = description + '<div class="col-sm-12">';
                            description = description + '<textarea type="text" class="form-control" id="description" name="description" value='+response.danliris_pengeluarans.description+' ></textarea>';
                            description = description + '</div>';
                        }
                        else
                        {
                            description = '<label name="description" class="col-sm-4 control-label"> Deskripsi </label>';
                            description = description + '<div class="col-sm-12">';
                            description = description + '<textarea type="text" class="form-control" id="description" name="description" value='+response.danliris_pengeluarans.description+' >'+response.danliris_pengeluarans.description+'</textarea>';
                            description = description + '</div>';
                        }

                        unit = '<label name="unit_name" class="col-sm-4 control-label"> Unit </label>';
                        unit = unit + '<div class="col-sm-12">';
                        unit = unit + '<input type="text" class="form-control" id="unit_name" name="unit_name" value="'+response.danliris_pengeluarans.unit_name+'"  readonly>';
                        unit = unit + '</div>';

                        divisi = '<label name="division_name" class="col-sm-4 control-label"> Divisi </label>';
                        divisi = divisi + '<div class="col-sm-12">';
                        divisi = divisi + '<input type="text" class="form-control" id="division_name" name="division_name" value="'+response.danliris_pengeluarans.division_name+'"  readonly>';
                        divisi = divisi + '</div>';

                        var showForm = $('.pengeluaranForm').html(pengeluaran_type);
                        // var showForm_pemasukan_barcode = $('.permintaanForm').html(dropdown);
                        var showForm_cat_type = $('.tipeKategoriForm').html(category_type);
                        var showForm_cat_name = $('.namaKategoriForm').html(category_name);
                        var showForm_ast_name = $('.namaBarangForm').html(asset_name);
                        var showForm_barcode = $('.barcodeForm').html(barcode);
                        var showForm_ip = $('.assetipForm').html(asset_ip);
                        // var showForm_quantity = $('.quantityForm').html(quantity);
                        var showForm_desc = $('.deskripsiForm').html(description);
                        var showForm_user = $('.usernameForm').html(permintaan_user);
                        var showForm_unit = $('.unitForm').html(unit);
                        var showForm_divisi = $('.divisiForm').html(divisi);

                        if(response.danliris_pengeluarans.pengeluaran_type == "from permintaan")
                        {
                            if(get_nama_barang)
                            {
                                showForm.show()
                                // showForm_pemasukan_barcode.show()
                                showForm_cat_type.show();
                                showForm_cat_name.show();
                                showForm_ast_name.show();
                                showForm_barcode.show();
                                showForm_ip.show();
                                // showForm_quantity.hide();
                                showForm_desc.show();
                                showForm_user.show();
                                showForm_unit.show();
                                showForm_divisi.show();   
                            }
                            else
                            {
                                showForm_ast_name.hide();
                            }
                        }
                        else if(response.danliris_pengeluarans.pengeluaran_type == "to aval")
                        {
                            showForm_cat_type.show();
                            showForm_cat_name.show();
                            showForm_barcode.show();
                            showForm_ip.show();
                            showForm_desc.show();
                        }

                        $('#type_barcode').change(function(){
                            JsBarcode("#get_barcode", response.danliris_pengeluarans.barcode,
                            {
                                format: $('#type_barcode').val(),
                                text: $('#barcode').val(),
                                lineColor: "#000",
                                width: 4,
                                height: 100,
                                displayValue: true
                            });
                        })
                        // function print()
                        // {

                        // }

                        // window.jsPDF = window.jspdf.jsPDF;

                        // const doc = new jsPDF();
                        // var elementHandler  = {
                        //     '#ignored': function (element, renderer) {
                        //         return true;
                        //     }
                        // };

                        $('#printBarcode').on('click', function() {
                            var source = window.document.getElementById("print_barcode");
                            // $('#print_barcode').printElement({
                            //     printMode: 'popup'
                            // })

                            // doc.fromHTML(
                            //     $('#print_barcode').html(), 15, 15, {
                            //     'width': 170,
                                    // 'elementHandlers': specialElementHandlers
                            // });

                            // doc.fromHtml(source, 15, 15, {
                            //     'width' : 180,
                            //     'elementHandlers' : elementHandlers,
                            // });
                            // doc.save('sample-file.pdf');

                            var divContents = $("#print_barcode").html();
                            var printWindow = window.open('', '', 'height=400,width=800');
                            // printWindow.document.write('<html><head><title>DIV Contents</title>');
                            // printWindow.document.write('</head><body >');
                            printWindow.document.write(divContents);
                            // printWindow.document.write('</body></html>');
                            printWindow.document.close();
                            printWindow.print();
                        })
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
                danliris_pemasukan_id: $('#updatePengeluaranForm').find('#danliris_pemasukan_id').val(),
                category_type: $('#updatePengeluaranForm').find('#category_type').val(),
                category_name: $('#updatePengeluaranForm').find('#category_name').val(),
                barcode: $('#updatePengeluaranForm').find('#barcode').val(),
                asset_ip: $('#updatePengeluaranForm').find('#asset_ip').val(),
                // quantity: $('#updatePengeluaranForm').find('#quantity').val(),
                description: $('#updatePengeluaranForm').find('#description').val(),
                username: $('#updatePengeluaranForm').find('#username').val(),
                unit_name: $('#updatePengeluaranForm').find('#unit_name').val(),
                division_name: $('#updatePengeluaranForm').find('#division_name').val(),
            }

            $.ajax({
                url: "/danliris_pengeluaran/" + id,
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
                    url: "danliris_pengeluaran/" + id,
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
