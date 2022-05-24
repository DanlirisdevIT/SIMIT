@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Budget</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addBudget">
                                Tambah
                            </button>

                            <div class="row input-daterange">
                                <div class="col-md-4">
                                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date..." readonly/>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date..." readonly/>
                                </div>
                                
                                <div class="col-md-4">
                                    <button type="button" name="filter" id="filter" class="btn btn-outline-primary">Filter</button>
                                    <button type="button" name="clear" id="clear" class="btn btn-outline-secondary">Clear</button>
                                </div>

                                <!-- <div class="col-md-4">
                                    <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Refresh</button>
                                </div> -->
                            </div>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Budget UID</th>
                                        <th>Permintaan</th>
                                        <th>Grup</th>
                                        <th>Divisi</th>
                                        <th>Kategori</th>
                                        <th>Asset</th>
                                        <th>Permintaan Barang</th>
                                        <th>Realisasi</th>
                                        <th>Remind</th>
                                        <!-- <th>Harga</th> -->
                                        <th>Total Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="12" style="text-align:right">Total</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBudget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Budget</h5>
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
                            <input type="date" class="form-control" id="date" name="date" aria-label="date" aria-describedby="basic-addon1">
                            <!-- {{-- <div class="input-group-prepend">
                                <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                            </div> --}} -->
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label name="tipe_budgeting" class="col-sm-4 control-label"> Tipe Budgeting </label>
                    <select class="form-control" id="tipe_budgeting">
                        <option value="" selected="selected"> -- Pilih Tipe Budgeting -- </option>
                        <option value="permintaan_user"> Permintaan User </option>
                        <option value="order_rutin"> Order Rutin </option>
                    </select>
                </div>

                <!-- <div class="form-group">
                    <label name="danliris_permintaan_id" class="col-sm-4 control-label"> Permintaan </label>
                    <select class="form-control" id="danliris_permintaan_id" name="danliris_permintaan_id">
                        <option value="">---pilih user---</option> -->
                        <!-- @foreach ($danliris_permintaans as $permintaan)
                            @if($permintaan->deletedBy == '')
                                    <option value={{ $permintaan->id }}>{{$permintaan->dl_permintaan_uid}}</option>
                             @endif
                        @endforeach -->
                    <!-- </select>
                </div> -->

                <div class="form-group">
                    <div class="danliris_permintaan"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="group" class="col-sm-4 control-label"> Group </label>
                    <select class="form-control" id="group">
                        <option value="" selected="selected"> --Group-- </option>
                        <option value="Hardware"> Hardware </option>
                        <option value="Software"> Software </option>
                        <option value="Infrastuktur"> Infrastuktur </option>
                        <option value="Lain-lain"> Lain-lain </option>
                    </select>
                </div> -->

                <div class="form-group">
                    <div class="group"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="unit_id" class="col-sm-4 control-label"> Unit </label>
                    <select class="form-control" id="unit_id" name="unit_id" disabled>
                        {{-- @foreach ($units as $unit)
                            @if($unit->deletedBy == '')
                                <option value={{ $unit->id }}>{{ $unit->unit_name }} </option>
                            @endif
                        @endforeach --}}
                    </select>
                </div> -->

                <div class="form-group">
                    <div class="unitForm"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                    <select class="form-control" id="division_id" name="division_id" disabled>
                        {{-- @foreach ($divisions as $division)
                            @if($division->deletedBy == '')
                                <option value={{ $division->id }}>{{ $division->division_name }} </option>
                            @endif
                        @endforeach --}}
                    </select>
                </div> -->

                <div class="form-group">
                    <div class="divisionForm"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="category_id" class="col-sm-4 control-label"> Kategori </label>
                    <select class="form-control" id="category_id" name="category_id" disabled>

                        {{-- @foreach ($categories as $category)
                            @if($category->deletedBy == '')
                                <option value={{ $category->id }}>{{$category->category_name}}</option>
                            @endif
                        @endforeach --}}
                    </select>
                </div> -->

                <div class="form-group">
                    <div class="categoryForm"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                    <select class="form-control" id="asset_id" name="asset_id" disabled>

                        {{-- @foreach ($assets as $asset)
                            @if($asset->deletedBy == '')
                                <option value={{ $asset->id }}>{{$asset->asset_name}}</option>
                            @endif
                        @endforeach --}}
                    </select>
                </div> -->

                <div class="form-group">
                    <div class="assetsForm"></div>
                </div>
            
                <!-- <div class="d-flex justify-content-between row">
                    <div class="form-group">    
                        <label name="totalqty" class="col-sm-10 control-label"> Total Permintaan </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="totalqty" name="totalqty" placeholder="qty..." readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label name="quantity" class="col-sm-2 control-label"> Jumlah </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="quantity" name="quantity" value="0">
                         </div>
                    </div>
                    <div class="form-group">
                        <label name="remind" class="col-sm-2 control-label"> Sisa </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="remind" name="remind" value="0" readonly>
                        </div>
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="qtyForm"></div>
                    <div class="qty2Form"></div>
                    <div class="qty3Form"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="unitPrice" class="col-sm-6 control-label"> Harga per jumlah barang </label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="unitPrice" name="unitPrice" placeholder="Masukkan harga..." maxlength="50" >
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="unitPriceForm"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="totalPrice" class="col-sm-4 control-label"> Total Harga </label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="totalPrice" name="totalPrice" placeholder="total..." maxlength="50" readonly>
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="totalPriceForm"></div>
                </div>

                <!-- <div class="form-group">
                    <label name="description" class="col-sm-4 control-label"> Keterangan </label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50" ></textarea>
                    </div>
                </div> -->

                <div class="form-group">
                    <div class="descriptionForm"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                <button type="button" class="btn btn-primary create">Simpan</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="updateBudget" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Budget</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

                    <form id="updateBudgetForm" name="updateBudgetForm" class="form-horizontal">
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
                        <label name="danliris_permintaan_id" class="col-sm-4 control-label"> Permintaan </label>
                        <select class="form-control" id="danliris_permintaan_id" name="danliris_permintaan_id" disabled>
                            <!-- <option value="">---pilih user---</option>
                            @foreach ($danliris_permintaans as $permintaan)
                                @if($permintaan->deletedBy == '')
                                    <option value={{ $permintaan->id }}>{{$permintaan->username}}</option>
                                @endif
                            @endforeach -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="group" class="col-sm-4 control-label"> Group </label>
                        <select class="form-control" id="group">
                            <option value="Hardware"> --- Hardware --- </option>
                            <option value="Software"> --- Software --- </option>
                            <option value="License"> --- License --- </option>
                            <option value="Consumable"> --- Consumable --- </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="unit_id" class="col-sm-4 control-label"> Unit </label>
                        <select class="form-control" id="unit_id" name="unit_id" disabled>
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                        <select class="form-control" id="division_id" name="division_id" disabled>
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="category_id" class="col-sm-4 control-label"> Kategori </label>
                        <select class="form-control" id="category_id" name="category_id" disabled>
                        </select>
                    </div>


                    <div class="form-group">
                        <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                        <select class="form-control" id="asset_id" name="asset_id" disabled>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between row">
                        <div class="form-group">    
                            <label name="totalqty" class="col-sm-10 control-label"> Total Permintaan </label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="totalqty" name="totalqty" placeholder="qty..." readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label name="quantity" class="col-sm-2 control-label"> Jumlah </label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="quantity" name="quantity" value="0">
                            
                                <!-- <button type="button" class="btn btn-light add"><i class="fa fa-plus"></i></button> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label name="remind" class="col-sm-2 control-label"> Sisa </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="remind" name="remind" value="0">
                            
                                <!-- <button type="button" class="btn btn-light add"><i class="fa fa-plus"></i></button> -->
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="unitPrice" class="col-sm-6 control-label"> Harga per barang realisasi </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="unitPrice" name="unitPrice" placeholder="Masukkan harga..." maxlength="50" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="totalPrice" class="col-sm-4 control-label"> Total Harga </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="totalPrice" name="totalPrice" placeholder="Masukkan harga..." maxlength="50" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="description" class="col-sm-4 control-label"> Keterangan </label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50"></textarea>
                        </div>
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                    <button type="button" class="btn btn-primary update">Perbaharui</button>
                    <button type="button" class="btn btn-danger deleteBudget"><i class="far fa-trash-alt"></i></button>
                </div>
            </form>
          </div>
        </div>
    </div>


    <script type="text/javascript">
        // $(function() {
        //     $.ajaxSetup({
        //         headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     var table = $('.datatables').DataTable({
        //         autoWidth: false,
        //         processing: true,
        //         serverSide: true,
        //         ajax: "{{ route('danliris_budget.index') }}",
        //         method: 'GET',
        //         columns: [
        //             {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
        //             {data: 'date', name: 'date', width: '15%'},
        //             {data: 'budget_id', name: 'budget_id', width: '15%'},
        //             {data: 'danliris_permintaans.username', name: 'danliris_permintaans.username', width: '15%'},
        //             {data: 'group', name: 'group', width: '15%'},
        //             {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
        //             {data: 'categories.category_name', name: 'categories.category_name', width: '15%'},
        //             {data: 'assets.asset_name', name: 'assets.asset_name', width: '15%'},
        //             {data: 'totalqty', name: 'totalqty', width: '15%'},
        //             {data: 'quantity', name: 'quantity', width: '15%'},
        //             {data: 'remind', name: 'remind', width: '15%'},
        //             // {data: 'unitPrice', name: 'unitPrice', width: '15%'},
        //             {data: 'totalPrice', name: 'totalPrice', width: '15%'},
        //             {data: 'action', name: 'action', width: '10%'},
        //         ],
        //         order: [
        //             [0, 'desc'],
        //         ],
        //     });
        // });
        
        $(document).ready(function() {
            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format:'yyyy-mm-dd',
                autoclose: true,
            });

            load_date();

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function load_date(from_date = '', to_date = '')
            {
                $('.datatables').DataTable({
                    autoWidth: false,
                    processing: true,
                    serverSide: true,
                    footer: true,
                    ajax: {
                        url: "{{ route('danliris_budget.index') }}",
                        data: {from_date: from_date, to_date: to_date}
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                        {data: 'date', name: 'date', width: '15%'},
                        {data: 'budget_id', name: 'budget_id', width: '15%'},
                        {data: 'danliris_permintaans.username', name: 'danliris_permintaans.username', width: '15%'},
                        {data: 'group', name: 'group', width: '15%'},
                        {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
                        {data: 'categories.category_name', name: 'categories.category_name', width: '15%'},
                        {data: 'assets.asset_name', name: 'assets.asset_name', width: '15%'},
                        {data: 'totalqty', name: 'totalqty', width: '15%'},
                        {data: 'quantity', name: 'quantity', width: '15%'},
                        {data: 'remind', name: 'remind', width: '15%'},
                        // {data: 'unitPrice', name: 'unitPrice', width: '15%'},
                        {data: 'totalPrice', name: 'totalPrice', width: '15%', render: $.fn.dataTable.render.number( '.', '', 0, 'Rp' )},
                        {data: 'action', name: 'action', width: '10%'},
                    ],
                    footerCallback : function(row, data, start, end, display)
                    {
                        var api = this.api();

                        var currFormat = $.fn.dataTable.render.number( '.', '', 0, 'Rp' ).display;

                        var intVal = function (i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };

                        tP = api
                        .column(11, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                        $(api.column(11).footer()).html("Total : " + currFormat(tP))
                    }
                })
            }

            $('#filter').click(function () {
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();

                $('.datatables').DataTable().destroy();
                load_date(from_date, to_date);

            })

            $('#clear').click(function () {
                $('#from_date').val("");
                $('#to_date').val("");

                $('.datatables').DataTable()
            })

            // $('#refresh').click(function () {
            //     var from_date = $('#from_date').val("");
            //     var to_date = $('#to_date').val("");

            //     $('.datatables').DataTable().destroy();
            //     load_date();
            // })
        })

        // $('#danliris_permintaan_id').select2({
        //     theme: 'bootstrap4',
        //     dropdownParent: $('#addBudget')
        // })

        $(document).ready(function () {
            
            $('#tipe_budgeting').on('change', function() 
            {
                dropdown_permintaan = '<label name="danliris_permintaan_id" class="col-sm-4 control-label"> Permintaan </label>';
                dropdown_permintaan = dropdown_permintaan + '<select class="form-control" id="danliris_permintaan_id" name="danliris_permintaan_id">';
                dropdown_permintaan = dropdown_permintaan + '<option value="" selected="selected"> -- Pilih Permintaan -- </option>';
                dropdown_permintaan = dropdown_permintaan + '</select>';

                dropdown_group = '<label name="group" class="col-sm-4 control-label"> Group </label>';
                dropdown_group = dropdown_group + '<select class="form-control" id="group" name="group">';
                dropdown_group = dropdown_group + '<option value="" selected="selected"> -- Group -- </option>';
                dropdown_group = dropdown_group + '<option value="Hardware"> Hardware </option>';
                dropdown_group = dropdown_group + '<option value="Software"> Software </option>';
                dropdown_group = dropdown_group + '<option value="Infrastuktur"> Infrastuktur </option>';
                dropdown_group = dropdown_group + '<option value="Lain-lain"> Lain-lain </option>';
                dropdown_group = dropdown_group + '</select>';

                dropdown_unit = '<label name="unit_id" class="col-sm-4 control-label"> Unit </label>';
                dropdown_unit = dropdown_unit + '<select class="form-control" id="unit_id" name="unit_id">';
                dropdown_unit = dropdown_unit + '</select>';

                dropdown_divsion = '<label name="division_id" class="col-sm-4 control-label"> Divisi </label>';
                dropdown_divsion = dropdown_divsion + '<select class="form-control" id="division_id" name="division_id">';
                dropdown_divsion = dropdown_divsion + '</select>';

                dropdown_category = '<label name="category_id" class="col-sm-4 control-label"> Kategori </label>';
                dropdown_category = dropdown_category + '<select class="form-control" id="category_id" name="category_id">';
                dropdown_category = dropdown_category + '</select>';

                dropdown_assets = '<label name="asset_id" class="col-sm-4 control-label"> Barang </label>';
                dropdown_assets = dropdown_assets + '<select class="form-control" id="asset_id" name="asset_id">';
                dropdown_assets = dropdown_assets + '</select>';

                // quantity = '<div class="d-flex justify-content-between row">';
                quantity = '<div class="form-group">';
                quantity = quantity + '<label name="totalqty" class="col-sm-10 control-label"> Total Permintaan </label>';
                quantity = quantity + '<div class="col-sm-12">';
                quantity = quantity + '<input type="number" class="form-control" id="totalqty" name="totalqty" placeholder="qty..." readonly>';
                quantity = quantity + '</div>';
                quantity = quantity + '</div>';
                
                quantity2 = '<div class="form-group">';
                quantity2 = quantity2 + '<label name="quantity" class="col-sm-2 control-label"> Jumlah </label>';
                quantity2 = quantity2 + '<div class="col-sm-12">';
                quantity2 = quantity2 + '<input type="number" class="form-control" id="quantity" name="quantity" value="0">';
                quantity2 = quantity2 + '</div>';
                quantity2 = quantity2 + '</div>';
                
                quantity3 = '<div class="form-group">';
                quantity3 = quantity3 + '<label name="remind" class="col-sm-2 control-label"> Sisa </label>';
                quantity3 = quantity3 + '<div class="col-sm-12">';
                quantity3 = quantity3 + '<input type="number" class="form-control" id="remind" name="remind" value="0" readonly>';
                quantity3 = quantity3 + '</div>';
                quantity3 = quantity3 + '</div>';
                // quantity3 = quantity3 + '</div>';

                unit_price = '<label name="unitPrice" class="col-sm-8 control-label"> Harga per jumlah barang </label>';
                unit_price = unit_price + '<div class="col-sm-12">';
                unit_price = unit_price + '<input type="number" class="form-control" id="unitPrice" name="unitPrice" placeholder="Masukkan harga..." maxlength="50" >';
                unit_price = unit_price + '</div>';

                total_price = '<label name="totalPrice" class="col-sm-4 control-label"> Total Harga </label>';
                total_price = total_price + '<div class="col-sm-12">';
                total_price = total_price + '<input type="number" class="form-control" id="totalPrice" name="totalPrice" placeholder="total..." maxlength="50" readonly>';
                total_price = total_price + '</div>';

                description = '<label name="description" class="col-sm-4 control-label"> Deskripsi </label>';
                description = description + '<div class="col-sm-12">';
                description = description + '<textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50" ></textarea>';
                description = description + '</div>';

                var showForm_permintaan = $('.danliris_permintaan').html(dropdown_permintaan);
                var showForm_group = $('.group').html(dropdown_group);
                var showForm_unit = $('.unitForm').html(dropdown_unit);
                var showForm_division = $('.divisionForm').html(dropdown_divsion);
                var showForm_category = $('.categoryForm').html(dropdown_category);
                var showForm_assets = $('.assetsForm').html(dropdown_assets);
                var showForm_qty = $('.qtyForm').html(quantity);
                var showForm_qty2 = $('.qty2Form').html(quantity2);
                var showForm_qty3 = $('.qty3Form').html(quantity3);
                var showForm_unitPrice = $('.unitPriceForm').html(unit_price);
                var showForm_totalPrice = $('.totalPriceForm').html(total_price);
                var showForm_description = $('.descriptionForm').html(description);

                if(this.value == "permintaan_user")
                {
                    showForm_permintaan.show();
                    showForm_group.show();
                    showForm_unit.show();
                    showForm_division.show();
                    showForm_category.show();
                    showForm_assets.show();
                    showForm_qty.show();
                    showForm_qty2.show();
                    showForm_qty3.show();
                    showForm_unitPrice.show();
                    showForm_totalPrice.show();
                    showForm_description.show();

                    function fetchPermintaan()
                    {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('getDanliris_Permintaan') }}",
                            dataType: "json",
                            success: function(response)
                            {
                                if(response.status == 200)
                                {
                                    
                                    console.log(response.danliris_permintaan_all)
                                    $.each(response.danliris_permintaan_all, function(index, danliris_permintaans) {
                                        $('select[name="danliris_permintaan_id"]').append('<option value="'+danliris_permintaans.id+'">'+danliris_permintaans.dl_permintaan_uid+'</option>');
                                    })

                                    $('#danliris_permintaan_id').on('input', function() {
                                        var get_id = $('#danliris_permintaan_id').val()

                                        usePermintaan(get_id)
                                    })
                                }
                                
                            }
                        })
                    }

                    fetchPermintaan();

                    function usePermintaan(get_id)
                    {
                        $("#danliris_permintaan_id").on('change', function() {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: "GET",
                                url: "{{ route('danliris_budget.create') }}",
                                data:  { 'danliris_permintaan_id' : get_id },
                                dataType: "json",
                                beforeSend : function()
                                {
                                    console.log(danliris_permintaan_id);
                                },
                                success: function(response){
                                    if(response.status == 200)
                                    {
                                    $('#unit_id').val(response.units.unit_name);
                                    var option_units = '<option value = "'+response.units.id+'" selected> --- '+response.units.unit_name+' --- </option>'
                                    $('select[name="unit_id"]').html(option_units);

                                    $('#division_id').val(response.divisions.division_name);
                                    var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                                    $('select[name="division_id"]').html(option_division);

                                    $('#category_id').val(response.categories.category_name);
                                    var option_category = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                                    $('select[name="category_id"]').html(option_category);

                                    $('#asset_id').val(response.assets.asset_name);
                                    var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                                    $('select[name="asset_id"]').html(option_asset);

                                    $('#totalqty').val(response.danliris_permintaans.quantity);
                                    
                                    $("#quantity").keyup(function(){
                                        var totalquantity = $('#totalqty').val()
                                        var quantity = $('#quantity').val()
                                        var remind = $('#remind').val()

                                        // var substract = 0;

                                        // for(var i=0; i<0; i++){
                                        //     substract -= i
                                        // }

                                        if(quantity <= totalquantity)
                                        {
                                            var substract = parseInt(totalquantity) - parseInt(quantity)
                                        }
                                        // else
                                        // {
                                        //     $('#remind').text('nilai tidak bisa lebih besar dari total')                }
                                        // }
                                        $('#remind').val(parseInt(substract))
                                    });

                                    $("#quantity, #unitPrice").keyup(function(){
                                        var quantity = $('#quantity').val()
                                        var unitPrice = $('#unitPrice').val()

                                        var total_price = parseInt(quantity) * parseInt(unitPrice)
                                        $('#totalPrice').val(total_price)
                                    });
                                    }
                                }
                            })
                        })
                    }
                }
                else if(this.value == "order_rutin")
                {
                    showForm_permintaan.hide();
                    showForm_qty.hide();
                    showForm_qty2.show();
                    showForm_qty3.hide();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: "{{ route('getOrder_detail') }}",
                        // data:  { 'danliris_permintaan_id' : get_id },
                        dataType: "json",
                        // beforeSend : function()
                        // {
                        //     console.log(danliris_permintaan_id);
                        // },
                        success: function(response){
                            if(response.status == 200)
                            {
                            
                            console.log(response.order_units)
                            $.each(response.order_units, function(index, units) {
                                $('select[name="unit_id"]').append('<option value="'+units.id+'">'+units.unit_name+'</option>');
                            })

                            $.each(response.order_divisions, function(index, divisions) {
                                $('select[name="division_id"]').append('<option value="'+divisions.id+'">'+divisions.division_name+'</option>');
                            })
                            
                            $.each(response.order_categories, function(index, categories) {
                                $('select[name="category_id"]').append('<option value="'+categories.id+'">'+categories.category_name+'</option>');
                            })

                            $.each(response.order_assets, function(index, assets) {
                                $('select[name="asset_id"]').append('<option value="'+assets.id+'">'+assets.asset_name+'</option>');
                            })

                            $("#quantity, #unitPrice").keyup(function(){
                                var quantity = $('#quantity').val()
                                var unitPrice = $('#unitPrice').val()

                                var total_price = parseInt(quantity) * parseInt(unitPrice)
                                $('#totalPrice').val(total_price)
                            });
                            }
                        }
                    })
                }
            })

            $('.reset').click(function (){
                $('#date').val("")
                $('#danliris_permintaan_id').val($('#danliris_permintaan_id').data("default_value"))
                $('#group').val($('#group').data("default_value"))
                $('#division_id').val($('#division_id').data("default_value"))
                $('#category_id').val($('#category_id').data("default_value"))
                $('#asset_id').val($('#asset_id').data("default_value"))
                $('#quantity').val("")
                $('#unitPrice').val("")
                $('#totalPrice').val("")
                $('#description').val("")
            })

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date': $('#date').val(),
                    'danliris_permintaan_id': $('#danliris_permintaan_id').val(),
                    'group': $('#group').val(),
                    'unit_id': $('#unit_id').val(),
                    'division_id': $('#division_id').val(),
                    'category_id': $('#category_id').val(),
                    'asset_id': $('#asset_id').val(),
                    'quantity': $('#quantity').val(),
                    'totalqty': $('#totalqty').val(),
                    'remind': $('#remind').val(),
                    'unitPrice': $('#unitPrice').val(),
                    'totalPrice': $('#totalPrice').val(),
                    'description': $('#description').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('danliris_budget.store') }}",
                    dataType: "json",
                    beforeSend: function()
                    {
                        console.log(data)
                    },
                    success: function(response){
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
                            $('#addBudget').modal('hide');
                            $('#addBudget').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                            location.reload()
                        }
                    }
                })
            })
        })

        //edit/update
        $(document).on('click', '.editBudget', function (e){

            e.preventDefault();

            var id = $(this).data('id');

            $('#updateBudget').modal('show');

            $.ajax({
                type: "GET",
                url: "{{ route('danliris_budget.index') }}" + '/' + id + '/edit',
                success: function(response){
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editBudget').modal('hide');
                    }
                    else
                    {
                        $("#id").val(id);
                        $('#updateBudget').find('#date').val(response.danliris_budgets.date);

                        // $('#updateBudget').find("#danliris_permintaan_id").val(response.danliris_permintaans.username);
                        var option_permintaan = '<option value = "'+response.danliris_permintaans.id+'" selected> --- '+response.danliris_permintaans.dl_permintaan_uid+' --- </option>'
                        $('#updateBudget').find('select[name="danliris_permintaan_id"]').append(option_permintaan);

                        $('#updateBudget').find("#group").val("seletedIndex", 0);
                        // $('#updateBudget').find("#group").val(response.danliris_budgets.group);
                        var option_budget = '<option value = "'+response.danliris_budgets.group+'" selected> --- '+response.danliris_budgets.group+' --- </option>'
                        $('#updateBudget').find('select[name="group"]').append(option_budget);

                        // $('#updateBudget').find("#unit_id").val(response.units.unit_name);
                        var option_unit = '<option value = "'+response.units.id+'" selected> --- '+response.units.unit_name+' --- </option>'
                        $('#updateBudget').find('select[name="unit_id"]').append(option_unit);

                        // $('#updateBudget').find("#division_id").val(response.divisions.division_name);
                        var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                        $('#updateBudget').find('select[name="division_id"]').append(option_division);

                        // $('#updateBudget').find("#category_id").val(response.categories.category_name);
                        var option_category = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                        $('#updateBudget').find('select[name="category_id"]').append(option_category);

                        // $('#updateBudget').find("#asset_id").val(response.assets.asset_name);
                        var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                        $('#updateBudget').find('select[name="asset_id"]').append(option_asset);

                        $('#updateBudget').find("#quantity").val(response.danliris_budgets.quantity);
                        $('#updateBudget').find("#realisasi").val(response.danliris_budgets.realisasi);
                        $('#updateBudget').find("#unitPrice").val(response.danliris_budgets.unitPrice);
                        $('#updateBudget').find("#remind").val(response.danliris_budgets.remind);
                        $('#updateBudget').find("#totalqty").val(response.danliris_budgets.totalqty);

                        $('#updateBudget').find('#totalPrice').val(response.danliris_budgets.totalPrice);
                        $("#realisasi, #unitPrice").keyup(function(){
                                var realisasi = $('#updateBudget').find('#realisasi').val()
                                var unitPrice = $('#updateBudget').find('#unitPrice').val()

                                var total_price = parseInt(realisasi) * parseInt(unitPrice)
                            $('#updateBudget').find('#totalPrice').val(total_price)
                        });

                        $("#realisasi").keyup(function(){
                            var quantity = $('#updateBudget').find('#quantity').val()
                            var realisasi = $('#updateBudget').find('#realisasi').val()

                            if(quantity != NaN)
                            {
                                var substract = parseInt(quantity) - parseInt(realisasi)
                            }

                            $('#updateBudget').find('#quantity').val(parseInt(substract))
                        });

                        $('#updateBudget').find("#description").val(response.danliris_budgets.description);
                    }
                }
            })
        });

        $(document).on('click', '.update', function(e) {
            e.preventDefault();

            $(this).text('Memperbaharui...');

            var id = $('#id').val();
            // let formData = new FormData($('#updateBudgetForm')[0]);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var formData = {
                date: $('#updateBudgetForm').find('#date').val(),
                danliris_permintaan_id: $('#updateBudgetForm').find('#danliris_permintaan_id').val(),
                group: $('#updateBudgetForm').find('#group').val(),
                division_id: $('#updateBudgetForm').find('#division_id').val(),
                category_id: $('#updateBudgetForm').find('#category_id').val(),
                asset_id: $('#updateBudgetForm').find('#asset_id').val(),
                quantity: $('#updateBudgetForm').find('#quantity').val(),
                realisasi: $('#updateBudgetForm').find('#realisasi').val(),
                unitPrice: $('#updateBudgetForm').find('#unitPrice').val(),
                totalPrice: $('#updateBudgetForm').find('#totalPrice').val(),
                description: $('#updateBudgetForm').find('#description').val(),
            }
            console.log(formData);

            $.ajax({
                url: "/danliris_budget/" + id,
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
                        $('#updateBudget').find('input').val('');
                        $('.update').text('update');
                        $('#updateBudget').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload(); //untuk auto refresh halaman
                    }
                }
            })
        })

        $(document).on('click', '.deleteBudget', function () {
            var id = $('#id').val();
            console.log(id)

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
                    url: "danliris_budget/" + id,
                    type: "DELETE",
                    dataType: "json",
                    success:function (response) {
                        $('#updateBudget').modal('hide');
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload();
                    }
                })
            })
        });

    </script>
@endsection
