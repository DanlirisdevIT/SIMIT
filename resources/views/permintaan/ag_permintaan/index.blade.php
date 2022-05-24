@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Permintaan</h2>
                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addPermintaan">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Divisi</th>
                                        <th>Perusahaan</th>
                                        <th>Kategori</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        {{-- <th>Keterangan</th> --}}
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

    <div class="modal fade" id="addPermintaan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Permintaan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="overflow:hidden;">
                <ul id="saveForm_errList"></ul>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                        <div class="input-group mb-2">
                            <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1">
                            {{-- <div class="input-group-prepend">
                                <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="username" class="col-sm-4 control-label"> User </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label name="unit_id" class="col-sm-4 control-label"> Pilih Unit </label>
                    <select class="form-control select2" id="unit_id" name="unit_id" style="width: 100%;">
                        @foreach ($units as $unit)
                            @if($unit->deletedBy == '')
                                <option value={{ $unit->id }}>{{$unit->unit_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Pilih Divisi </label>
                        <select class="form-control" id="division_id" name="division_id">
                            {{-- <option value="">Select An Option</option> --}}
                            @foreach ($divisions as $division)
                                @if($division->deletedBy == '')
                                    <option value={{ $division->id }}>{{$division->division_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                        <label name="company_id" class="col-sm-4 control-label"> Pilih Perusahaan </label>
                        <select class="form-control" id="company_id" name="company_id">
                            @foreach ($companies as $company)
                                @if ($company->deletedBy == '')
                                    <option value={{ $company->id }}>{{$company->companyName}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                        <select class="form-control" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                                @if($category->deletedBy == '')
                                    <option value={{ $category->id }}>{{$category->category_type}} - {{$category->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="asset_id" class="col-sm-4 control-label"> Pilih Barang </label>
                        <select class="form-control select2" id="asset_id" name="asset_id" style="width: 100%;">
                            @foreach ($assets as $asset)
                                @if($asset->deletedBy == '')
                                    <option value={{ $asset->id }}>{{$asset->asset_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label name="quantity" class="col-sm-4 control-label"> Jumlah </label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan Jumlah..." maxlength="50" required>
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
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                <button type="button" class="btn btn-primary create">Simpan</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="updatePermintaan" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Permintaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                    {{-- <div class="modal-body" style="overflow:hidden;"> --}}
                        <form id="updatePermintaanForm" name="updatePermintaanForm" class="form-horizontal">
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
                                    <label name="username" class="col-sm-4 control-label"> User </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="username" name="username">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label name="unit_id" class="col-sm-4 control-label"> Pilih Unit </label>
                                    <select class="form-control select2" id="unit_id" name="unit_id" style="width: 100%;">
                                        @foreach ($units as $unit)
                                            @if($unit->deletedBy == '')
                                                <option value={{ $unit->id }}>{{$unit->unit_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label name="division_id" class="col-sm-4 control-label"> Pilih Divisi </label>
                                    <select class="form-control" id="division_id" name="division_id">
                                        {{-- <option value="">Select An Option</option> --}}
                                        @foreach ($divisions as $division)
                                            @if($division->deletedBy == '')
                                                <option value={{ $division->id }}>{{$division->division_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label name="company_id" class="col-sm-4 control-label"> Pilih Perusahaan </label>
                                    <select class="form-control" id="company_id" name="company_id">
                                        @foreach ($companies as $company)
                                            @if ($company->deletedBy == '')
                                                <option value={{ $company->id }}>{{$company->companyName}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label name="category_id" class="col-sm-4 control-label"> Pilih Kategori </label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        @foreach ($categories as $category)
                                            @if($category->deletedBy == '')
                                                <option value={{ $category->id }}>{{$category->category_type}} - {{$category->category_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label name="asset_id" class="col-sm-4 control-label"> Pilih Barang </label>
                                    <select class="form-control select2" id="asset_id" name="asset_id" style="width: 100%;">
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
                                    <label name="description" class="col-sm-4 control-label"> Keterangan </label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50" required></textarea>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                            <button type="button" class="btn btn-primary update">Perbaharui</button>
                            <button type="button" class="btn btn-danger deletePermintaan"><i class="far fa-trash-alt"></i></button>
                        </div>

                    {{-- </div> --}}
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
                ajax: "{{ route('ag_permintaan.index') }}",
                method: 'GET',
                // type: "GET",
                // url: "{{ route('permintaan.index') }}" + '/' + 'getDanliris',
                destroy: true,
                columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                        {data: 'date', name: 'date', width: '15%' },
                        {data: 'username', name: 'username', width: '15%'},
                        {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
                        {data: 'companies.companyName', name: 'companies.companyName', width: '15%'},
                        {data: 'categories.category_name', name: 'categories.categories_name', width: '15%'},
                        {data: 'assets.asset_name', name: 'assets.asset_name', width: '15%'},
                        {data: 'quantity', name: 'quantity', width: '15%'},
                        // {data: 'description', name: 'description', width: '15%'},
                        {data: 'action', name: 'action', width: '5%'},
                    ],
                    order: [
                        [0, 'desc'],
                    ],
            });
        })

        $('#asset_id').select2({
            theme: 'bootstrap4'
        })

        $('#unit_id').select2({
            theme: 'bootstrap4'
        })

        $(document).ready(function () {
            $('.reset').click(function (){
                $('#date').val("")
                $('#company_id').val($('#company_id').data("default_value"))
                $('#category_id').val($('#category_id').data("default_value"))
                $('#division_id').val($('#division_id').data("default_value"))
                $('#asset_id').val($('#asset_id').data("default_value"))
                $('#unit_id').val($('#unit_id').data("default_value"))
                $('#quantity').val("")
                $('#description').val("")
            })

            // $('#date').datepicker({
            //     format: 'dd-mm-yyyy',
            //     autoclose: true,
            //     locale: 'en'
            // });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date': $('#date').val(),
                    'username': $('#username').val(),
                    'division_id': $('#division_id').val(),
                    'company_id': $('#company_id').val(),
                    'category_id': $('#category_id').val(),
                    'asset_id': $('#asset_id').val(),
                    'unit_id': $('#unit_id').val(),
                    'quantity': $('#quantity').val(),
                    'description': $('#description').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('ag_permintaan.store') }}",
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
                            $('#addPermintaan').modal('hide');
                            $('#addPermintaan').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                            location.reload()
                        }
                    }
                })
            })
        })

        $('#updatePermintaan').find('#asset_id').select2({
            theme: 'bootstrap4',
        });

        $('#updatePermintaan').find('#unit_id').select2({
            theme: 'bootstrap4',
        });

        $(document).on('click', '.editPermintaan', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#updatePermintaan').modal('show');

            var company = $('#select_company').val()

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('ag_permintaan.index') }}" + '/' + id + '/edit',
                success: function (response) {
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editPermintaan').modal('hide');
                    }
                    else
                    {
                        // $('.EditPermintaanBody').html(response.html)
                        $(".reset-update").click( function(){
                            // $('#updatePermintaanForm').find('#date').val("")
                            $('#updatePermintaanForm').find('#username').val("")
                            $('#updatePermintaanForm').find('#unit_id').val("selectedIndex", 0);
                            $('#updatePermintaanForm').find('#division_id').val("selectedIndex", 0);
                            $('#updatePermintaanForm').find('#company_id').val("selectedIndex", 0);
                            $('#updatePermintaanForm').find('#category_id').val("selectedIndex", 0);
                            // $('#updatePermintaanForm').find('#asset_id').val("selectedIndex", 0);
                            $('#updatePermintaanForm').find('#quantity').val("");
                            $('#updatePermintaanForm').find('#description').val("");

                        });
                        $('#updatePermintaan').find('#date').datepicker({
                            format: 'dd-mm-yyyy',
                            autoclose: true,
                            locale: 'en'
                        });
                        // $('#updatePermintaan').find('#asset_id').select2({
                        //     theme: 'bootstrap4'
                        // });
                        // $("#date").html(response.permintaans['date']);
                        // $("#username").html(response.permintaans['username']);
                        // $("#division_id").html(response.permintaans['division_id']);
                        // $("#company_id").html(response.permintaans['company_id']);
                        // $("#category_id").html(response.permintaans['category_id']);
                        // $("#asset_id").html(response.permintaans['asset_id']);
                        // $("#quantity").html(response.permintaans['quantity']);
                        // $("#description").html(response.permintaans['description']);
                        // console.log(response.permintaans['date'])
                        // console.log(response.permintaans['username'])
                        $("#id").val(id);

                        $('#updatePermintaan').find('#date').val(response.ag_permintaans.date);
                        $('#updatePermintaan').find('#username').val(response.ag_permintaans.username);

                        $('#updatePermintaan').find('#unit_id').val(response.units.unit_name);
                        var option_unit = '<option value = "'+response.units.id+'" selected> --- '+response.units.unit_name+' --- </option>'
                        $('#updatePermintaan').find('select[name="unit_id"]').append(option_unit);

                        $('#updatePermintaan').find('#division_id').val(response.divisions.division_name);
                        var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                        $('#updatePermintaan').find('select[name="division_id"]').append(option_division);

                        $('#updatePermintaan').find('#company_id').val(response.companies.companyName);
                        var option_company = '<option value = "'+response.companies.id+'" selected> --- '+response.companies.companyName+' --- </option>'
                        $('#updatePermintaan').find('select[name="company_id"]').append(option_company);

                        $('#updatePermintaan').find('#category_id').val(response.categories.category_name);
                        var option_category = '<option value = "'+response.categories.id+'" selected> --- '+response.categories.category_name+' --- </option>'
                        $('#updatePermintaan').find('select[name="category_id"]').append(option_category);

                        $('#updatePermintaan').find('#asset_id').val(response.assets.asset_name);
                        var option_asset = '<option value = "'+response.assets.id+'" selected> --- '+response.assets.asset_name+' --- </option>'
                        $('#updatePermintaan').find('select[name="asset_id"]').append(option_asset);

                        $('#updatePermintaan').find('#quantity').val(response.ag_permintaans.quantity);
                        $('#updatePermintaan').find('#description').val(response.ag_permintaans.description);
                    }
                }
            })
        })

        $(document).on('click', '.update', function (e) {
            e.preventDefault();

            $(this).text('Memperbaharui');

            var id = $('#id').val();

            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });

            // var data = $('#updatePermintaanForm').serialize();
            // let formData = new FormData($('#updatePermintaanForm')[0]);
            var formData = {
                date: $('#updatePermintaanForm').find('#date').val(),
                username: $('#updatePermintaanForm').find('#username').val(),
                category_id: $('#updatePermintaanForm').find('#category_id').val(),
                division_id: $('#updatePermintaanForm').find('#division_id').val(),
                company_id: $('#updatePermintaanForm').find('#company_id').val(),
                asset_id: $('#updatePermintaanForm').find('#asset_id').val(),
                unit_id: $('#updatePermintaanForm').find('#unit_id').val(),
                quantity: $('#updatePermintaanForm').find('#quantity').val(),
                description: $('#updatePermintaanForm').find('#description').val(),
            };


            console.log(formData)

            $.ajax({
                url: "/ag_permintaan/" + id,
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
                        $('#updatePermintaan').find('input').val('');
                        $('.update').text('update');
                        $('#updatePermintaan').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload()
                    }
                }
            })
        })

        $(document).on('click', '.deletePermintaan', function() {
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
                    url: "ag_permintaan/" + id,
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
                            $('#updatePermintaan').modal('hide')
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
