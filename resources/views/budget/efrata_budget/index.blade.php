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

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Budget ID</th>
                                        <th>Permintaan</th>
                                        <th>Grup</th>
                                        <th>Divisi</th>
                                        <th>Kategori</th>
                                        <th>Asset</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
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
                            <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1">
                            <!-- {{-- <div class="input-group-prepend">
                                <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                            </div> --}} -->
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label name="efrata_permintaan_id" class="col-sm-4 control-label"> Permintaan </label>
                    <select class="form-control" id="efrata_permintaan_id" name="efrata_permintaan_id">
                        <option value="">---pilih user---</option>
                        @foreach ($efrata_permintaans as $permintaan)
                            @if($permintaan->deletedBy == '')
                                    <option value={{ $permintaan->id }}>{{$permintaan->username}}</option>
                             @endif
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label name="group" class="col-sm-4 control-label"> Group </label>
                    <select class="form-control" id="group">
                        <option value="" selected="selected"> --Group-- </option>
                        <option value="Hardware"> Hardware </option>
                        <option value="Software"> Software </option>
                        <option value="Infrastuktur"> Infrastuktur </option>
                        <option value="Lain-lain"> Lain-lain </option>
                    </select>
                </div>

                    <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Divisi </label>
                        <select class="form-control" id="division_id" name="division_id" disabled>
                            {{-- @foreach ($divisions as $division)
                                @if($division->deletedBy == '')
                                    <option value={{ $division->id }}>{{ $division->division_name }} </option>
                                @endif
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="category_id" class="col-sm-4 control-label"> Kategori </label>
                        <select class="form-control" id="category_id" name="category_id" disabled>

                            {{-- @foreach ($categories as $category)
                                @if($category->deletedBy == '')
                                    <option value={{ $category->id }}>{{$category->category_name}}</option>
                                @endif
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="asset_id" class="col-sm-4 control-label"> Barang </label>
                        <select class="form-control" id="asset_id" name="asset_id" disabled>

                            {{-- @foreach ($assets as $asset)
                                @if($asset->deletedBy == '')
                                    <option value={{ $asset->id }}>{{$asset->asset_name}}</option>
                                @endif
                            @endforeach --}}
                        </select>
                    </div>

                <div class="form-group">
                    <label name="quantity" class="col-sm-4 control-label"> Qty </label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="qty..." >
                    </div>
                </div>

                <div class="form-group">
                    <label name="unitPrice" class="col-sm-4 control-label"> Harga </label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="unitPrice" name="unitPrice" placeholder="Masukkan harga..." maxlength="50" >
                    </div>
                </div>

                <div class="form-group">
                    <label name="totalPrice" class="col-sm-4 control-label"> Total Harga </label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="totalPrice" name="totalPrice" placeholder="total..." maxlength="50" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label name="description" class="col-sm-4 control-label"> Keterangan </label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50" ></textarea>
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
                            {{-- <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar-alt" id="date"></i></span>
                            </div> --}}
                            <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="efrata_permintaan_id" class="col-sm-4 control-label"> Permintaan </label>
                        <select class="form-control" id="efrata_permintaan_id" name="efrata_permintaan_id">
                            <option value="">---pilih user---</option>
                            @foreach ($efrata_permintaans as $permintaan)
                                @if($permintaan->deletedBy == '')
                                    <option value={{ $permintaan->id }}>{{$permintaan->username}}</option>
                                @endif
                            @endforeach
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

                    <div class="form-group">
                        <label name="quantity" class="col-sm-4 control-label"> Qty </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah..." maxlength="50" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="unitPrice" class="col-sm-4 control-label"> Harga </label>
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
                ajax: "{{ route('efrata_budget.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'date', name: 'date', width: '15%'},
                    {data: 'budget_id', name: 'budget_id', width: '15%'},
                    {data: 'efrata_permintaans.username', name: 'efrata_permintaans.username', width: '15%'},
                    {data: 'group', name: 'group', width: '15%'},
                    {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
                    {data: 'categories.category_name', name: 'categories.category_name', width: '15%'},
                    {data: 'assets.asset_name', name: 'assets.asset_name', width: '15%'},
                    {data: 'quantity', name: 'quantity', width: '15%'},
                    {data: 'unitPrice', name: 'unitPrice', width: '15%'},
                    {data: 'totalPrice', name: 'totalPrice', width: '15%'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        });

        $(document).ready(function () {

            $("#efrata_permintaan_id").on('change', function() {
                    var efrata_permintaan_id = $("#efrata_permintaan_id").val();
                    console.log(efrata_permintaan_id)

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "GET",
                        url: "{{ route('efrata_budget.create') }}",
                        data:  { 'efrata_permintaan_id' : efrata_permintaan_id },
                        dataType: "json",
                        beforeSend : function()
                        {
                            console.log(efrata_permintaan_id);
                        },
                        success: function(response){
                            if(response.status == 200)
                            {
                            $('#division_id').val(response.divisions.division_name);
                            var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                            $('select[name="division_id"]').append(option_division);

                            $('#category_id').val(response.categories.category_name);
                            var option_category = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                            $('select[name="category_id"]').append(option_category);

                            $('#asset_id').val(response.assets.asset_name);
                            var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                            $('select[name="asset_id"]').append(option_asset);

                            $('#quantity').val(response.efrata_permintaans.quantity);
                            }
                        }
                    })
            })

            $('.reset').click(function (){
                $('#date').val("")
                $('#efrata_permintaan_id').val($('#efrata_permintaan_id').data("default_value"))
                $('#group').val($('#group').data("default_value"))
                $('#division_id').val($('#division_id').data("default_value"))
                $('#category_id').val($('#category_id').data("default_value"))
                $('#asset_id').val($('#asset_id').data("default_value"))
                $('#quantity').val("")
                $('#unitPrice').val("")
                $('#totalPrice').val("")
                $('#description').val("")
            })

            $("#quantity, #unitPrice").keyup(function(){
                        var quantity = $('#quantity').val()
                        var unitPrice = $('#unitPrice').val()

                        var total_price = parseInt(quantity) * parseInt(unitPrice)
                        $('#totalPrice').val(total_price)
                    });

            // $('#date').datepicker({
            //     format: 'dd-mm-yyyy',
            //     autoclose: true,
            //     locale: 'en'
            // });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date': $('#date').val(),
                    'efrata_permintaan_id': $('#efrata_permintaan_id').val(),
                    'group': $('#group').val(),
                    'division_id': $('#division_id').val(),
                    'category_id': $('#category_id').val(),
                    'asset_id': $('#asset_id').val(),
                    'quantity': $('#quantity').val(),
                    'unitPrice': $('#unitPrice').val(),
                    'totalPrice': $('#totalPrice').val(),
                    'description': $('#description').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('efrata_budget.store') }}",
                    dataType: "json",
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
                url: "{{ route('efrata_budget.index') }}" + '/' + id + '/edit',
                success: function(response){
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editBudget').modal('hide');
                    }
                    else
                    {
                        $("#id").val(id);
                        $('#updateBudget').find('#date').val(response.efrata_budgets.date);

                        $('#updateBudget').find("#efrata_permintaan_id").val(response.efrata_permintaans.username);
                        var option_permintaan = '<option value = "'+response.efrata_permintaans.id+'" selected> --- '+response.efrata_permintaans.username+' --- </option>'
                        $('#updateBudget').find('select[name="efrata_permintaan_id"]').append(option_permintaan);

                        $('#updateBudget').find("#group").val("seletedIndex", 0);
                        $('#updateBudget').find("#group").val(response.efrata_budgets.group);
                        var option_budget = '<option value = "'+response.efrata_budgets.group+'" selected> --- '+response.efrata_budgets.group+' --- </option>'
                        $('#updateBudget').find('select[name="group"]').append(option_budget);

                        $('#updateBudget').find("#division_id").val(response.divisions.division_name);
                        var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                        $('#updateBudget').find('select[name="division_id"]').append(option_division);

                        $('#updateBudget').find("#category_id").val(response.categories.category_name);
                        var option_category = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                        $('#updateBudget').find('select[name="category_id"]').append(option_category);

                        $('#updateBudget').find("#asset_id").val(response.assets.asset_name);
                        var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                        $('#updateBudget').find('select[name="asset_id"]').append(option_asset);

                        $('#updateBudget').find("#quantity").val(response.efrata_budgets.quantity);
                        $('#updateBudget').find("#unitPrice").val(response.efrata_budgets.unitPrice);

                        $('#updateBudget').find('#totalPrice').val(response.efrata_budgets.totalPrice);
                        $("#quantity, #unitPrice").keyup(function(){
                            var quantity = $('#updateBudget').find('#quantity').val()
                            var unitPrice = $('#updateBudget').find('#unitPrice').val()

                            var total_price = parseInt(quantity) * parseInt(unitPrice)
                        $('#updateBudget').find('#totalPrice').val(total_price)
                    });

                        $('#updateBudget').find("#description").val(response.efrata_budgets.description);
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
                efrata_permintaan_id: $('#updateBudgetForm').find('#efrata_permintaan_id').val(),
                group: $('#updateBudgetForm').find('#group').val(),
                division_id: $('#updateBudgetForm').find('#division_id').val(),
                category_id: $('#updateBudgetForm').find('#category_id').val(),
                asset_id: $('#updateBudgetForm').find('#asset_id').val(),
                quantity: $('#updateBudgetForm').find('#quantity').val(),
                unitPrice: $('#updateBudgetForm').find('#unitPrice').val(),
                totalPrice: $('#updateBudgetForm').find('#totalPrice').val(),
                description: $('#updateBudgetForm').find('#description').val(),
            }
            console.log(formData);

            $.ajax({
                url: "/efrata_budget/" + id,
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
                    url: "efrata_budget/" + id,
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
