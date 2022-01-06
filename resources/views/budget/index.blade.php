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
                                        <th>Permintaan</th>
                                        <th>Grup</th>
                                        <th>Divisi</th>
                                        <th>Kategori</th>
                                        <th>Asset</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
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

                
                    <div class="form-group">
                        <label name="permintaan_id" class="col-sm-4 control-label"> Pilih Permintaan </label>
                        <select class="form-control" id="permintaan_id" name="permintaan_id">
                            @foreach ($permintaans as $permintaan)
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
                        <option value="Software"> License </option>
                        <option value="Software"> Consumable </option>
                    </select>
                </div>

                    <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Pilih Divisi </label>
                        <select class="form-control" id="division_id" name="division_id">
                            <option value="">Pilih  Divisi----</option>
                            @foreach ($divisions as $division)
                                @if($division->deletedBy == '')
                                    <option value={{ $division->id }}>{{$division->division_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">Pilih  Kategori----</option>
                            @foreach ($categories as $category)
                                @if($category->deletedBy == '')
                                    <option value={{ $category->id }}>{{$category->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
               
                   
                
                    <div class="form-group">
                        <label name="asset_id" class="col-sm-4 control-label"> Pilih Barang </label>
                        <select class="form-control" id="asset_id" name="asset_id">
                            <option value="">Pilih  barang----</option>
                            @foreach ($assets as $asset)
                                @if($asset->deletedBy == '')
                                    <option value={{ $asset->id }}>{{$asset->asset_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                

                <div class="form-group">
                    <label name="quantity" class="col-sm-4 control-label"> Jumlah </label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah..." maxlength="50" required>
                    </div>
                </div>

                <div class="form-group">
                    <label name="unitPrice" class="col-sm-4 control-label"> Harga </label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="unitPrice" name="unitPrice" placeholder="Masukkan harga..." maxlength="50" required>
                    </div>
                </div>

                <div class="form-group">
                    <label name="description" class="col-sm-4 control-label"> Keterangan </label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50" required></textarea>
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
            <form id="updateBudgetForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <ul id="updateForm_errList"></ul>
                    <input type="hidden" id="id">

                    <div class="form-group">
                        <label name="permintaan_id" class="col-sm-4 control-label"> Pilih Permintaan </label>
                        <select class="form-control" id="permintaan_id" name="permintaan_id">
                            @foreach ($permintaans as $permintaan)
                                @if($permintaan->deletedBy == '')
                                    <option value={{ $permintaan->id }}>{{$permintaan->username}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                

                {{-- <div class="form-group">
                    <label name="group" class="col-sm-4 control-label"> Group </label>
                    <select class="form-control" id="group">
                        <option value="group" selected="selected"> --Group-- </option>
                        <option value="Hardware"> Hardware </option>
                        <option value="Software"> Software </option>
                        <option value="Software"> License </option>
                        <option value="Software"> Consumable </option>
                    </select>
                </div> --}}

                <div class="form-group">
                    <label name="group" class="col-sm-4 control-label"> Group </label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="group" name="group" placeholder="Group..." maxlength="50" required>
                    </div>
                </div>

                    <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Pilih Divisi </label>
                        <select class="form-control" id="division_id" name="division_id">
                            @foreach ($divisions as $division)
                                @if ($division->deletedBy == '')
                                    <option value={{ $division->id }}>{{$division->division_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                                @if($category->deletedBy == '')
                                    <option value={{ $category->id }}>{{$category->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
    
                    
                    <div class="form-group">
                        <label name="asset_id" class="col-sm-4 control-label"> Pilih Barang </label>
                        <select class="form-control" id="asset_id" name="asset_id">
                            @foreach ($assets as $asset)
                                @if($asset->deletedBy == '')
                                    <option value={{ $asset->id }}>{{$asset->asset_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label name="quantity" class="col-sm-4 control-label"> Jumlah </label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah..." maxlength="50" required>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label name="unitPrice" class="col-sm-4 control-label"> Harga </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="unitPrice" name="unitPrice" placeholder="Masukkan harga..." maxlength="50" required>
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
                ajax: "{{ route('budget.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'permintaans.username', name: 'permintaans.username', width: '15%'},
                    {data: 'group', name: 'group', width: '15%'},
                    {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
                    {data: 'categories.category_name', name: 'categories.category_name', width: '15%'},
                    {data: 'assets.asset_name', name: 'assets.asset_name', width: '15%'},
                    {data: 'quantity', name: 'quantity', width: '15%'},
                    {data: 'unitPrice', name: 'unitPrice', width: '15%'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        });

        $(document).ready(function () {
            $('.reset').click(function (){

            })
            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'permintaan_id': $('#permintaan_id').val(),
                    'group': $('#group').val(),
                    'division_id': $('#division_id').val(),
                    'category_id': $('#category_id').val(),
                    'asset_id': $('#asset_id').val(),
                    'quantity': $('#quantity').val(),
                    'unitPrice': $('#unitPrice').val(),
                    'description': $('#description').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('budget.store') }}",
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
                            $('#addBudget').modal('hide');
                            $('#addBudget').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
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
                url: "{{ route('budget.index') }}" + '/' + id + '/edit',
                success: function(response){
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editBudget').modal('hide');
                    }
                    else
                    {
                        $('#btnDelete').html(response.html)
                        $(".reset-update").click( function(){
                            $('#updateBudgetForm').find('#permintaan_id').val("selectedIndex", 0);
                            // $('#updateBudgetForm').find('#group').val("selectedIndex", 0);
                            $('#updateBudgetForm').find('#group').val("");
                            $('#updateBudgetForm').find('#division_id').val("selectedIndex", 0);
                            $('#updateBudgetForm').find('#category_id').val("selectedIndex", 0);
                            $('#updateBudgetForm').find('#asset_id').val("selectedIndex", 0);
                            $('#updateBudgetForm').find('#quantity').val("");
                            $('#updateBudgetForm').find('#unitPrice').val("");
                            $('#updateBudgetForm').find('#description').val("");
                        });
                        $("#id").val(id);

                        var option_permintaan = '<option value = "'+response.permintaans.id+'" selected> --- '+response.permintaans.username+' --- </option>'
                        $('#updateBudget').find('select[name="permintaan_id"]').append(option_permintaan);

                        $('#updateBudget').find("#group").val(response.budgets.group);

                        var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                        $('#updateBudget').find('select[name="division_id"]').append(option_division);

                        // var option_category = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                        // $('#updateBudget').find('select[name="category_id"]').append(option_category);

                        var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                        $('#updateBudget').find('select[name="asset_id"]').append(option_asset);

                        $('#updateBudget').find("#quantity").val(response.budgets.quantity);
                        $('#updateBudget').find("#unitPrice").val(response.budgets.unitPrice);
                        $('#updateBudget').find("#description").val(response.budgets.description);
                    }
                }
            })
        });

        $(document).on('click', '.update', function(e) {
            e.preventDefault();

            $(this).text('Memperbaharui...');

            var id = $('#id').val();
            console.log(id)

            let formData = new FormData($('#updateBudgetForm')[0]);
            console.log(formData)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/budget/" + id,
                method: 'POST',
                data:
                formData,
                dataType: "json",
                contentType: false,
                processData: false,
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
                    url: "budget/" + id,
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
