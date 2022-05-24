@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Pemasukan</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addPemasukan">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>AG UID</th>
                                        <th>User</th>
                                        <th>Tipe Pemasukan</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Kategori</th>
                                        <th>Nama Barang</th>
                                        <th>Barcode</th>
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

    <div class="modal fade" id="addPemasukan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Pemasukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <ul id="saveForm_errList"></ul>
                        <div class="form-group">
                            <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                            <div class="input-group mb-2">
                                <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1">
                                {{-- <div class="input-group-prepend">
                                    <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                                </div> --}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label name="pemasukan_type" class="col-sm-4 control-label"> Tipe Pemasukan </label>
                            <select class="form-control" id="pemasukan_type" name="pemasukan_type">
                                <option value=""> -- Pilih Tipe Pemasukan -- </option>
                                <option value="to user"> To User </option>
                                <option value="to it stock"> To IT Stock </option>
                                <option value="replacement"> Replacement </option>
                            </select>
                        </div>

                        {{-- <div class="form-group">
                            <label name="status" class="col-sm-4 control-label"> Status </label>
                            <select class="form-control" id="status" name="status">
                                <option value=""> -- Pilih Status -- </option>
                                <option value="budget"> Budget </option>
                                <option value="replacement"> Replacement </option>
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label name="ag_budget_id" class="col-sm-4 control-label"> Budget </label>
                            <select class="form-control" id="ag_budget_id" name="ag_budget_id">
                                <option value=""> -- Pilih Budget -- </option>
                                @foreach ($ag_budgets as $budget)
                                    <option value="{{ $budget->id }}"> {{ $budget->budget_id}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="addedForm"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm2"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm3"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedFormUnit"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedFormNamaPengembali"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm4"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm5"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm6"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm7"></div>
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

    <div class="modal fade" id="updatePemasukan" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pemasukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="updatePemasukanForm" name="updatePemasukanForm" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="overflow:hidden;">
                        <ul id="updateForm_errList"></ul>
                        <input type="hidden" id="id">

                        <div class="form-group">
                            <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                            <div class="input-group mb-2">
                                {{-- <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt" id="date"></i></span>
                                </div> --}}
                                <input type="date" class="form-control" id="date" name="date" value={{ old('date', date('Y-m-d')) }} aria-label="date" aria-describedby="basic-addon1">
                            </div>
                        </div>

                        <div class="form-group">
                            <label name="pemasukan_type" class="col-sm-4 control-label"> Tipe Pemasukan </label>
                            <select class="form-control" id="pemasukan_type" name="pemasukan_type">
                                <option value=""> -- Pilih Tipe Pemasukan -- </option>
                                <option value="to user"> To User </option>
                                <option value="to it stock"> To IT Stock </option>
                                <option value="replacement"> Replacement </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label name="ag_budget_id" class="col-sm-4 control-label"> Budget </label>
                            <select class="form-control" id="ag_budget_id" name="ag_budget_id">
                                <option value=""> -- Pilih Budget -- </option>
                                @foreach ($ag_budgets as $budget)
                                    <option value="{{ $budget->id }}"> {{ $budget->budget_id}} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label name="ag_uid" class="col-sm-4 control-label"> AG UID </label>
                            <input type="text" class="form-control" id="ag_uid" name="ag_uid" maxlength="50" readonly>
                        </div>

                        <div class="form-group">
                            <div class="addedFormUpdate"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm2Update"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm3Update"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm4Update"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm5Update"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm6Update"></div>
                        </div>

                        <div class="form-group">
                            <div class="addedForm7Update"></div>
                        </div>

                    </div>

                </form>
                <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                    <button type="button" class="btn btn-primary update">Perbaharui</button>
                    <button type="button" class="btn btn-danger deletePemasukan"><i class="far fa-trash-alt"></i></button>
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
                ajax: "{{ route('ag_pemasukan.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'date', name: 'date', width: '15%'},
                    {data: 'ag_uid', name: 'ag_uid', width: '15%'},
                    {data: 'user', name: 'user', width: '15%'},
                    {data: 'pemasukan_type', name: 'pemasukan_type', width: '15%'},
                    // {data: 'status', name: 'status', width: '15%'},
                    {data: 'category_type', name: 'category_type', width: '15%'},
                    {data: 'category_name', name: 'category_name', width: '15%'},
                    {data: 'barcode', name: 'barcode', width: '15%'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        });

        //js create form
        $(document).ready(function () {
            // $('#date').datepicker({
            //     format: 'dd-mm-yyyy',
            //     autoclose: true,
            //     locale: 'en'
            // });

            $.ajax({
                url: "{{ route('ag_pemasukan.create') }}",
                type: "GET",
                dataType: "json",
                success: function(response){

                    $('#pemasukan_type').on('change', function() {
                        var pemasukan_type = $('#pemasukan_type').val();

                        console.log(pemasukan_type)

                        dropdown = '<label name="ag_permintaan_id" class="col-sm-4 control-label"> User Peminta </label>';
                        dropdown = dropdown + '<select class="form-control" id="ag_permintaan_id" name="ag_permintaan_id">';
                        dropdown = dropdown + '</select>';

                        dropdown_supplier = '<label name="supplier_id" class="col-sm-4 control-label"> Supplier </label>';
                        dropdown_supplier = dropdown_supplier + '<select class="form-control" id="supplier_id" name="supplier_id">';
                        dropdown_supplier = dropdown_supplier + '</select>';

                        dropdown_manufacture = '<label name="manufacture_id" class="col-sm-4 control-label"> Manufacture </label>';
                        dropdown_manufacture = dropdown_manufacture + '<select class="form-control" id="manufacture_id" name="manufacture_id">';
                        dropdown_manufacture = dropdown_manufacture + '</select>';

                        dropdown_unit = '<label name="unit_id" class="col-sm-4 control-label"> Unit </label>';
                        dropdown_unit = dropdown_unit + '<select class="form-control" id="unit_id" name="unit_id">';
                        dropdown_unit = dropdown_unit + '</select>';

                        pengembalian = '<label name="replacement_by" class="col-sm-4 control-label"> User Pengembali </label>';
                        pengembalian = pengembalian + '<div class="col-sm-12">';
                        pengembalian = pengembalian + '<input type="text" class="form-control" id="replacement_by" name="replacement_by" maxlength="50" required>';
                        pengembalian = pengembalian + '</div>';

                        var showForm_unit = $('.addedFormUnit').html(dropdown_unit);

                        var showForm_pengembalian = $('.addedFormNamaPengembali').html(pengembalian);

                        var showForm_supplier = $('.addedForm2').html(dropdown_supplier);

                        var showForm_manufacture = $('.addedForm3').html(dropdown_manufacture);

                        var showForm = $('.addedForm').html(dropdown);

                        if(pemasukan_type == "to user")
                        {
                            $.each(response.suppliers, function(index, suppliers) {
                            // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                                $('select[name="supplier_id"]').append('<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>');
                            })

                            $.each(response.manufactures, function(index, manufactures) {
                            // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                                $('select[name="manufacture_id"]').append('<option value="'+manufactures.id+'">'+manufactures.manufactureName+'</option>');
                            })

                            $.each(response.ag_permintaans, function(index, permintaans) {
                                $('select[name="ag_permintaan_id"]').append('<option value="'+permintaans.id+'">'+permintaans.username+'</option>')
                            })

                            showForm_supplier.show();
                            showForm_manufacture.show();
                            showForm.show();
                            showForm_unit.hide();
                            showForm_pengembalian.hide();
                        }
                        else if(pemasukan_type == "to it stock")
                        {
                            $.each(response.suppliers, function(index, suppliers) {
                            // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                                $('select[name="supplier_id"]').append('<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>');
                            })

                            $.each(response.manufactures, function(index, manufactures) {
                            // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                                $('select[name="manufacture_id"]').append('<option value="'+manufactures.id+'">'+manufactures.manufactureName+'</option>');
                            })

                            showForm_supplier.show();
                            showForm_manufacture.show();
                            showForm.hide();
                            showForm_unit.hide();
                            showForm_pengembalian.hide();
                        }
                        else if(pemasukan_type == "replacement")
                        {
                            $.each(response.units, function(index, units) {
                                $('select[name="unit_id"]').append('<option value="'+units.id+'">'+units.unit_name+'</option>')
                            })

                            showForm_supplier.hide();
                            showForm_manufacture.hide();
                            showForm.hide();
                            showForm_unit.show();
                            showForm_pengembalian.show();
                        }
                    });

                    // $("#status").on('change', function() {
                    //     var status = $('#status').val();

                    //     console.log(status)

                    //     if(status == "budget")
                    //     {
                    //         dropdown_supplier = '<label name="supplier_id" class="col-sm-4 control-label"> Supplier </label>';
                    //         dropdown_supplier = dropdown_supplier + '<select class="form-control" id="supplier_id" name="supplier_id">';
                    //         dropdown_supplier = dropdown_supplier + '</select>';

                    //         dropdown_manufacture = '<label name="manufacture_id" class="col-sm-4 control-label"> Manufacture </label>';
                    //         dropdown_manufacture = dropdown_manufacture + '<select class="form-control" id="manufacture_id" name="manufacture_id">';
                    //         dropdown_manufacture = dropdown_manufacture + '</select>';

                    //         var showForm_supplier = $('.addedForm2').html(dropdown_supplier);
                    //         showForm_supplier.show();

                    //         var showForm_manufacture = $('.addedForm3').html(dropdown_manufacture);
                    //         showForm_manufacture.show();

                    //         $.each(response.suppliers, function(index, suppliers) {
                    //         // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                    //             $('select[name="supplier_id"]').append('<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>');
                    //         })

                    //         $.each(response.manufactures, function(index, manufactures) {
                    //         // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                    //             $('select[name="manufacture_id"]').append('<option value="'+manufactures.id+'">'+manufactures.manufactureName+'</option>');
                    //         })
                    //     }
                    //     else if(status == "replacement")
                    //     {
                    //         dropdown_unit = '<label name="unit_id" class="col-sm-4 control-label"> Unit </label>';
                    //         dropdown_unit = dropdown_unit + '<select class="form-control" id="unit_id" name="unit_id">';
                    //         dropdown_unit = dropdown_unit + '</select>';

                    //         pengembalian = '<label name="replacement_by" class="col-sm-4 control-label"> User Pengembali </label>';
                    //         pengembalian = pengembalian + '<div class="col-sm-12">';
                    //         pengembalian = pengembalian + '<input type="text" class="form-control" id="replacement_by" name="replacement_by" maxlength="50" required>';
                    //         pengembalian = pengembalian + '</div>';

                    //         var showForm_unit = $('.addedForm2').html(dropdown_unit);
                    //         showForm_unit.show();

                    //         var showForm_pengembalian = $('.addedForm3').html(pengembalian);
                    //         showForm_pengembalian.show();

                    //         $.each(response.units, function(index, units) {
                    //             $('select[name="unit_id"]').append('<option value="'+units.id+'">'+units.unit_name+'</option>')
                    //         })
                    //     }
                    // });
                }
            });

            $("#ag_budget_id").on('change', function() {
                var ag_budget_id = $("#ag_budget_id").val();
                console.log(ag_budget_id)

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: "{{ route('ag_pemasukan.create') }}",
                    data:  { 'ag_budget_id' : ag_budget_id },
                    dataType: "json",
                    beforeSend : function()
                    {
                        console.log(ag_budget_id);
                    },
                    success: function(response){
                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                        category_type = category_type + '<div class="col-sm-12">';
                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.getCategories.category_type+'" maxlength="50" readonly>';
                        category_type = category_type + '</div>';

                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                        category_name = category_name + '<div class="col-sm-12">';
                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.getCategories.category_name+'" maxlength="50" readonly>';
                        category_name = category_name + '</div>';

                        barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                        barcode = barcode + '<div class="col-sm-12">';
                        barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" maxlength="50" required>';
                        barcode = barcode + '</div>';

                        console.log(response.getCategories)
                        var showForm_category = $('.addedForm4').html(category_type);
                        var showForm_category = $('.addedForm5').html(category_name);
                        var showForm_category = $('.addedForm6').html(barcode);
                        showForm_category.show();

                        if(response.getCategories.category_name == "Laptop" || response.getCategories.category_name == "PC")
                        {
                            spesifikasi = '<label name="spesifikasi" class="col-sm-12 control-label"> Spesifikasi Barang </label>';

                            spesifikasi = spesifikasi + '<label name="merk" class="col-sm-4 control-label"> Merk </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="merk" name="merk" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="motherboard" class="col-sm-4 control-label"> Motherboard </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="motherboard" name="motherboard" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="processor" class="col-sm-4 control-label"> Processor </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="processor" name="processor" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="harddisk_slot_1" class="col-sm-4 control-label"> HD Slot 1 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="harddisk_slot_1" name="harddisk_slot_1" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="harddisk_slot_2" class="col-sm-4 control-label"> HD Slot 2 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="harddisk_slot_2" name="harddisk_slot_2" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="ram_slot_1" class="col-sm-4 control-label"> RAM Slot 1 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="ram_slot_1" name="ram_slot_1" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="ram_slot_2" class="col-sm-4 control-label"> RAM Slot 2 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="ram_slot_2" name="ram_slot_2" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="dvd_internal" class="col-sm-4 control-label"> DVD Internal </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="dvd_internal" name="dvd_internal" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="power_supply" class="col-sm-4 control-label"> Power Supply </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="power_supply" name="power_supply" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="casing" class="col-sm-4 control-label"> Casing </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="casing" name="casing" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="fan_processor" class="col-sm-4 control-label"> Fan Processor </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="fan_processor" name="fan_processor" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            var showForm_spesifikasi = $('.addedForm7').html(spesifikasi);
                            showForm_spesifikasi.show();

                        }
                        else if(response.getCategories.category_name == "Scanner" || response.getCategories.category_name == "Printer")
                        {
                            spesifikasi = '<label name="spesifikasi" class="col-sm-12 control-label"> Spesifikasi Barang </label>';

                            spesifikasi = spesifikasi + '<label name="id_seri" class="col-sm-4 control-label"> ID Seri </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="id_seri" name="id_seri" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="no_seri" class="col-sm-4 control-label"> Nomor Seri </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="no_seri" name="no_seri" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            var showForm_spesifikasi = $('.addedForm7').html(spesifikasi);
                            showForm_spesifikasi.show();

                        }
                        else
                        {

                            spesifikasi = '';

                            var showForm_spesifikasi = $('.addedForm7').html(spesifikasi);
                            showForm_spesifikasi.hide();
                        }
                    }
                })
            })

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date': $('#date').val(),
                    'pemasukan_type': $('#pemasukan_type').val(),
                    'ag_permintaan_id': $('#ag_permintaan_id').val(),
                    // 'status': $('#status').val(),
                    'ag_budget_id': $('#ag_budget_id').val(),
                    'supplier_id': $('#supplier_id').val(),
                    'manufacture_id': $('#manufacture_id').val(),
                    'category_type' : $('#category_type').val(),
                    'category_name' : $('#category_name').val(),
                    'unit_id' : $('#unit_id').val(),
                    'replacement_by' : $('#replacement_by').val(),
                    'barcode' : $('#barcode').val(),
                    'merk' : $('#merk').val(),
                    'motherboard' : $('#motherboard').val(),
                    'harddisk_slot_1' : $('#harddisk_slot_1').val(),
                    'harddisk_slot_2' : $('#harddisk_slot_2').val(),
                    'ram_slot_1' : $('#ram_slot_1').val(),
                    'ram_slot_2' : $('#ram_slot_2').val(),
                    'dvd_internal' : $('#dvd_internal').val(),
                    'power_supply' : $('#power_supply').val(),
                    'casing' : $('#casing').val(),
                    'fan_processor' : $('#fan_processor').val(),
                    'id_seri' : $('#id_seri').val(),
                    'no_seri' : $('#no_seri').val(),
                }

                console.log(data)

                $.ajax({
                    type : "POST",
                    url : "{{ route('ag_pemasukan.store') }}",
                    data : data,
                    dataType : "json",
                    success : function(response){
                        if(response.status == 400)
                        {
                            $('#saveForm_errList').html("");
                            $('#saveForm_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveForm_errList').append('<li>'+err_values+'</li>');
                            });
                        }
                        else if(response.status == 200)
                        {
                            $('#saveForm_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.messages);
                            $('#addPemasukan').modal('hide');
                            $('#addPemasukan').find('input').val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                            location.reload()
                        }
                    },
                })
            });

        })

        //end js create form

        //edit form
        $(document).on('click', '.editPemasukan', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#updatePemasukan').modal('show');

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('ag_pemasukan.index') }}" + '/' + id + '/edit',
                dataType: "json",
                success: function (response) {
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editPermintaan').modal('hide');
                    }
                    else
                    {
                        // $('#updatePemasukan').find('#date').datepicker({
                        //     format: 'dd-mm-yyyy',
                        //     autoclose: true,
                        //     locale: 'en'
                        // });
                        $("#id").val(id);
                        $('#updatePemasukan').find('#date').val(response.ag_pemasukans.date);
                        $('#updatePemasukan').find('#pemasukan_type').val(response.ag_pemasukans.pemasukan_type);
                        $('#updatePemasukan').find('#ag_uid').val(response.ag_pemasukans.ag_uid);
                        // $('#updatePemasukan').find('#status').val(response.pemasukans.status);

                        $('#updatePemasukan').find('#ag_budget_id').val(response.ag_budgets.budget_id);
                        var option_budget = '<option value = "'+response.ag_budgets.id+'" selected> --- '+response.ag_budgets.budget_id+' --- </option>'
                        $('#updatePemasukan').find('select[name="ag_budget_id"]').append(option_budget);

                        // Bagian form pemasukan type
                        dropdown = '<label name="ag_permintaan_id" class="col-sm-4 control-label"> User Peminta </label>';
                        dropdown = dropdown + '<select class="form-control" id="ag_permintaan_id" name="ag_permintaan_id">';
                        dropdown = dropdown + '</select>';

                        dropdown_supplier = '<label name="supplier_id" class="col-sm-4 control-label"> Supplier </label>';
                        dropdown_supplier = dropdown_supplier + '<select class="form-control" id="supplier_id" name="supplier_id">';
                        dropdown_supplier = dropdown_supplier + '</select>';

                        dropdown_manufacture = '<label name="manufacture_id" class="col-sm-4 control-label"> Manufacture </label>';
                        dropdown_manufacture = dropdown_manufacture + '<select class="form-control" id="manufacture_id" name="manufacture_id">';
                        dropdown_manufacture = dropdown_manufacture + '</select>';

                        dropdown_unit = '<label name="unit_id" class="col-sm-4 control-label"> Unit </label>';
                        dropdown_unit = dropdown_unit + '<select class="form-control" id="unit_id" name="unit_id">';
                        dropdown_unit = dropdown_unit + '</select>';

                        pengembalian = '<label name="replacement_by" class="col-sm-4 control-label"> User Pengembali </label>';
                        pengembalian = pengembalian + '<div class="col-sm-12">';
                        pengembalian = pengembalian + '<input type="text" class="form-control" id="replacement_by" name="replacement_by" maxlength="50" required>';
                        pengembalian = pengembalian + '</div>';

                        var showForm_unit = $('.addedForm2Update').html(dropdown_unit);

                        var showForm_pengembalian = $('.addedForm3Update').html(pengembalian);

                        var showForm_supplier = $('.addedForm2Update').html(dropdown_supplier);

                        var showForm_manufacture = $('.addedForm3Update').html(dropdown_manufacture);

                        var showForm = $('.addedFormUpdate').html(dropdown);
                        // console.log(response.units.unit_name)

                        //value yang tersimpan
                        // var ag_permintaan_id = response.permintaans.id ? response.permintaans.id : " " ;
                        // var permintaan_username = response.permintaans.username ? response.permintaans.username : " " ;

                        if(!response.ag_pemasukans.ag_permintaan_id)
                        {
                            showForm.hide();
                        }
                        else
                        {
                            $('#updatePemasukan').find('#ag_permintaan_id').val(response.ag_permintaans.username);
                            var option_permintaan = '<option value = "'+response.ag_permintaans.id+'" selected="selected"> --- '+response.ag_permintaans.username+' --- </option>'
                            $('select[name="ag_permintaan_id"]').append(option_permintaan);
                        }

                        //option yang bisa dipilih
                        $.each(response.ag_permintaansAll, function(index, permintaans) {
                            $('select[name="ag_permintaan_id"]').append('<option value="'+permintaans.id+'">'+permintaans.username+'</option>')
                        })

                        $('#updatePemasukan').find('#supplier_id').val(response.suppliers.supplier_name);
                        var option_supplier = '<option value = "'+response.suppliers.id+'" selected="selected"> --- '+response.suppliers.supplier_name+' --- </option>'
                        $('#updatePemasukan').find('select[name="supplier_id"]').append(option_supplier);

                        $('#updatePemasukan').find('#manufacture_id').val(response.manufactures.manufactureName);
                        var option_manufacture = '<option value = "'+response.manufactures.id+'" selected="selected"> --- '+response.manufactures.manufactureName+' --- </option>'
                        $('#updatePemasukan').find('select[name="manufacture_id"]').append(option_manufacture);

                        $.each(response.suppliersAll, function(index, suppliers) {
                        // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                            $('select[name="supplier_id"]').append('<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>');
                        })

                        $.each(response.manufacturesAll, function(index, manufactures) {
                        // var option_supplier = '<option value="'+suppliers.id+'">'+suppliers.supplier_name+'</option>';
                            $('select[name="manufacture_id"]').append('<option value="'+manufactures.id+'">'+manufactures.manufactureName+'</option>');
                        })

                        if(response.ag_pemasukans.pemasukan_type == "to user")
                        {
                            showForm_supplier.show();
                            showForm_manufacture.show();
                            showForm.show();
                        }
                        else if(response.ag_pemasukans.pemasukan_type == "to it stock")
                        {
                            showForm.hide();
                            showForm_supplier.show();
                            showForm_manufacture.show();
                        }
                        else if(response.ag_pemasukans.pemasukan_type == "replacement")
                        {
                            $('#updatePemasukan').find('#unit_id').val(response.units.unit_name);
                            var option_unit = '<option value = "'+response.units.id+'" selected="selected"> --- '+response.units.unit_name+' --- </option>'
                            $('#updatePemasukan').find('select[name="unit_id"]').append(option_unit);

                            $.each(response.unitsAll, function(index, units) {
                                $('select[name="unit_id"]').append('<option value="'+units.id+'">'+units.unit_name+'</option>')
                            })

                            showForm.hide();
                            showForm_unit.show();
                            showForm_pengembalian.show();
                        }

                        $('#updatePemasukan').find('#pemasukan_type').on('change', function() {
                            var pemasukan_type = $('#updatePemasukan').find('#pemasukan_type').val();

                            console.log(pemasukan_type)

                            if(pemasukan_type == "to user")
                            {
                                showForm_supplier.show();
                                showForm_manufacture.show();
                                showForm.show();
                            }
                            else if(pemasukan_type == "to it stock")
                            {
                                showForm_supplier.show();
                                showForm_manufacture.show();
                                showForm.hide();
                            }
                            else if(pemasukan_type == "replacement")
                            {
                                if(!response.ag_pemasukans.unit_id)
                                {
                                    // var option_unit = 'data unit tidak tersedia'
                                    // $('#updatePemasukan').find('select[name="unit_id"]').append(option_unit);

                                    showForm_supplier.hide();
                                    showForm_manufacture.hide();
                                    showForm.hide();
                                    showForm_unit.hide();
                                    showForm_pengembalian.hide();
                                }
                                else if(response.ag_pemasukans.unit_id)
                                {
                                    $('#updatePemasukan').find('#unit_id').val(response.units.unit_name);
                                    var option_unit = '<option value = "'+response.units.id+'" selected="selected"> --- '+response.units.unit_name+' --- </option>'
                                    $('#updatePemasukan').find('select[name="unit_id"]').append(option_unit);

                                    $.each(response.unitsAll, function(index, units) {
                                        $('select[name="unit_id"]').append('<option value="'+units.id+'">'+units.unit_name+'</option>')
                                    })

                                    showForm_supplier.hide();
                                    showForm_manufacture.hide();
                                    showForm.hide();
                                    showForm_unit.show();
                                    showForm_pengembalian.show();
                                }
                            }
                        });
                        // akhir bagian pemasukan type

                        category_type = '<label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>';
                        category_type = category_type + '<div class="col-sm-12">';
                        category_type = category_type + '<input type="text" class="form-control" id="category_type" name="category_type" value="'+response.ag_pemasukans.category_type+'" maxlength="50" readonly>';
                        category_type = category_type + '</div>';

                        category_name = '<label name="category_name" class="col-sm-4 control-label"> Nama Barang </label>';
                        category_name = category_name + '<div class="col-sm-12">';
                        category_name = category_name + '<input type="text" class="form-control" id="category_name" name="category_name" value="'+response.ag_pemasukans.category_name+'" maxlength="50" readonly>';
                        category_name = category_name + '</div>';

                        barcode = '<label name="barcode" class="col-sm-4 control-label"> Barcode </label>';
                        barcode = barcode + '<div class="col-sm-12">';
                        barcode = barcode + '<input type="text" class="form-control" id="barcode" name="barcode" value="'+response.ag_pemasukans.barcode+'" maxlength="50" required>';
                        barcode = barcode + '</div>';

                        var showForm_category = $('.addedForm4Update').html(category_type);
                        var showForm_category = $('.addedForm5Update').html(category_name);
                        var showForm_category = $('.addedForm6Update').html(barcode);
                        showForm_category.show();

                        var merk = response.ag_pemasukans.merk ? response.ag_pemasukans.merk : " " ;
                        var motherboard = response.ag_pemasukans.motherboard ? response.ag_pemasukans.motherboard : " " ;
                        var processor = response.ag_pemasukans.processor ? response.ag_pemasukans.processor : " " ;
                        var casing = response.ag_pemasukans.casing ? response.ag_pemasukans.casing : " " ;
                        var harddisk_slot_1 = response.ag_pemasukans.harddisk_slot_1 ? response.ag_pemasukans.harddisk_slot_1 : " " ;
                        var harddisk_slot_2 = response.ag_pemasukans.harddisk_slot_2 ? response.ag_pemasukans.harddisk_slot_2 : " " ;
                        var ram_slot_1 = response.ag_pemasukans.ram_slot_1 ? response.ag_pemasukans.ram_slot_1 : " " ;
                        var ram_slot_2 = response.ag_pemasukans.ram_slot_2 ? response.ag_pemasukans.ram_slot_2 : " " ;
                        var fan_processor = response.ag_pemasukans.fan_processor ? response.ag_pemasukans.fan_processor : " " ;
                        var dvd_internal = response.ag_pemasukans.dvd_internal ? response.ag_pemasukans.dvd_internal : " " ;
                        var power_supply = response.ag_pemasukans.power_supply ? response.ag_pemasukans.power_supply : " " ;
                        var id_seri = response.ag_pemasukans.id_seri ? response.ag_pemasukans.id_seri : " " ;
                        var no_seri = response.ag_pemasukans.no_seri ? response.ag_pemasukans.no_seri : " " ;

                        if(response.ag_pemasukans.category_name == "Laptop" || response.ag_pemasukans.category_name == "PC")
                        {
                            spesifikasi = '<label name="spesifikasi" class="col-sm-12 control-label"> Spesifikasi Barang </label>';

                            spesifikasi = spesifikasi + '<label name="merk" class="col-sm-4 control-label"> Merk </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="merk" name="merk" value= "'+merk+'" "maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="motherboard" class="col-sm-4 control-label"> Motherboard </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="motherboard" name="motherboard" value= "'+motherboard+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="processor" class="col-sm-4 control-label"> Processor </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="processor" name="processor" value= "'+processor+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="harddisk_slot_1" class="col-sm-4 control-label"> HD Slot 1 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="harddisk_slot_1" name="harddisk_slot_1" value= "'+harddisk_slot_1+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="harddisk_slot_2" class="col-sm-4 control-label"> HD Slot 2 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="harddisk_slot_2" name="harddisk_slot_2" value= "'+harddisk_slot_2+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="ram_slot_1" class="col-sm-4 control-label"> RAM Slot 1 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="ram_slot_1" name="ram_slot_1" value= "'+ram_slot_1+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="ram_slot_2" class="col-sm-4 control-label"> RAM Slot 2 </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="ram_slot_2" name="ram_slot_2" value= "'+ram_slot_1+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="dvd_internal" class="col-sm-4 control-label"> DVD Internal </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="dvd_internal" name="dvd_internal" value= "'+dvd_internal+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="power_supply" class="col-sm-4 control-label"> Power Supply </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="power_supply" name="power_supply" value= "'+power_supply+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="casing" class="col-sm-4 control-label"> Casing </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="casing" name="casing" value= "'+casing+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="fan_processor" class="col-sm-4 control-label"> Fan Processor </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="fan_processor" name="fan_processor" value= "'+fan_processor+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            var showForm_spesifikasi = $('.addedForm7Update').html(spesifikasi);
                            showForm_spesifikasi.show();

                        }
                        else if(response.ag_pemasukans.category_name == "Scanner" || response.ag_pemasukans.category_name == "Printer")
                        {
                            spesifikasi = '<label name="spesifikasi" class="col-sm-12 control-label"> Spesifikasi Barang </label>';

                            spesifikasi = spesifikasi + '<label name="id_seri" class="col-sm-4 control-label"> ID Seri </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="id_seri" name="id_seri" value= "'+id_seri+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            spesifikasi = spesifikasi + '<label name="no_seri" class="col-sm-4 control-label"> Nomor Seri </label>';
                            spesifikasi = spesifikasi + '<div class="col-sm-12">';
                            spesifikasi = spesifikasi + '<input type="text" class="form-control" id="no_seri" name="no_seri" value= "'+no_seri+'" maxlength="50">';
                            spesifikasi = spesifikasi + '</div>';

                            var showForm_spesifikasi = $('.addedForm7Update').html(spesifikasi);
                            showForm_spesifikasi.show();

                        }
                        else
                        {
                            spesifikasi = '';

                            var showForm_spesifikasi = $('.addedForm7Update').html(spesifikasi);
                            showForm_spesifikasi.hide();
                        }
                    }
                }
            })
        })
        //end of edit form

        //js update
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
                ag_uid: $('#updatePemasukanForm').find('#ag_uid').val(),
                date: $('#updatePemasukanForm').find('#date').val(),
                pemasukan_type: $('#updatePemasukanForm').find('#pemasukan_type').val(),
                ag_permintaan_id: $('#updatePemasukanForm').find('#ag_permintaan_id').val(),
                // 'status': $('#updatePemasukanForm').find('#status').val(),
                ag_budget_id: $('#updatePemasukanForm').find('#ag_budget_id').val(),
                supplier_id: $('#updatePemasukanForm').find('#supplier_id').val(),
                manufacture_id: $('#updatePemasukanForm').find('#manufacture_id').val(),
                category_type : $('#updatePemasukanForm').find('#category_type').val(),
                category_name : $('#updatePemasukanForm').find('#category_name').val(),
                unit_id : $('#updatePemasukanForm').find('#unit_id').val(),
                replacement_by : $('#updatePemasukanForm').find('#replacement_by').val(),
                barcode : $('#updatePemasukanForm').find('#barcode').val(),
                merk : $('#updatePemasukanForm').find('#merk').val(),
                motherboard : $('#updatePemasukanForm').find('#motherboard').val(),
                harddisk_slot_1 : $('#updatePemasukanForm').find('#harddisk_slot_1').val(),
                harddisk_slot_2 : $('#updatePemasukanForm').find('#harddisk_slot_2').val(),
                ram_slot_1 : $('#updatePemasukanForm').find('#ram_slot_1').val(),
                ram_slot_2 : $('#updatePemasukanForm').find('#ram_slot_2').val(),
                dvd_internal : $('#updatePemasukanForm').find('#dvd_internal').val(),
                power_supply : $('#updatePemasukanForm').find('#power_supply').val(),
                casing : $('#updatePemasukanForm').find('#casing').val(),
                fan_processor : $('#updatePemasukanForm').find('#fan_processor').val(),
                id_seri : $('#updatePemasukanForm').find('#id_seri').val(),
                no_seri : $('#updatePemasukanForm').find('#no_seri').val(),
            };

            console.log(formData)

            $.ajax({
                url: "/ag_pemasukan/" + id,
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
                        $('#updatePemasukan').find('input').val('');
                        $('.update').text('update');
                        $('#updatePemasukan').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload()
                    }
                }
            })
        })
        //end js update

        //js delete
        $(document).on('click', '.deletePemasukan', function() {
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
                    url: "ag_pemasukan/" + id,
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
                            $('#updatePemasukan').modal('hide')
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
