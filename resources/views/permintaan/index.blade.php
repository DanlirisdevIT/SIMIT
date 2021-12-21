@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">List Permintaan</h2>
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

    <div class="modal fade" id="addPermintaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Permintaan</h5>
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
                            <input type="text" class="form-control" id="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1" readonly>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="username" class="col-sm-4 control-label"> User </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username" value="{{  Auth::user()->name }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="division_id" class="col-sm-4 control-label"> Pilih Divisi </label>
                        <select class="form-control" id="division_id" name="division_id">
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
                                    <option value={{ $category->id }}>{{$category->category_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-body1">
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

    <div class="modal fade" id="updatePermintaan" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Permintaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                {{-- <form id="updatePermintaanForm" action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') --}}
                    <div class="modal-body">
                        <ul id="updateForm_errList"></ul>
                        <input type="hidden" id="id">

                        <div class="EditPermintaanBody">

                        </div>
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
                ajax: "{{ route('permintaan.index') }}",
                method: 'GET',
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

        $(document).ready(function () {
            $('.reset').click(function (){

            })

            $('#date').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                locale: 'en'
            });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'date': $('#date').val(),
                    'username': $('#username').val(),
                    'division_id': $('#division_id').val(),
                    'company_id': $('#company_id').val(),
                    'category_id': $('#category_id').val(),
                    'asset_id': $('#asset_id').val(),
                    'quantity': $('#quantity').val(),
                    'description': $('#description').val(),
                }

                $.ajax({
                    method: "POST",
                    data: data,
                    url: "{{ route('permintaan.store') }}",
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
                            $('#addPermintaan').modal('hide');
                            $('#addPermintaan').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                        }
                    }
                })
            })
        })

        $(document).on('click', '.editPermintaan', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#updatePermintaan').modal('show');

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('permintaan.index') }}" + '/' + id + '/edit',
                success: function (response) {
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editPermintaan').modal('hide');
                    }
                    else
                    {
                        $('.EditPermintaanBody').html(response.html)
                        // $(".reset-update").click( function(){
                        //     $('.EditDivisionBody').find('#division_name').val("");
                        // });
                        // $('.EditDivisionBody').find('#date').datepicker({
                        //     format: 'MM/DD/YYYY',
                        //     locale: 'en'
                        // });
                        $("#date").html(response.permintaans['date']);
                        $("#username").html(response.permintaans['username']);
                        $("#division_id").html(response.divisions['division_id']);
                        $("#company_id").html(response.companies['company_id']);
                        $("#category_id").html(response.categories['category_id']);
                        $("#asset_id").html(response.assets['asset_id']);
                        console.log(response.permintaans['date'])
                        console.log(response.permintaans['username'])
                        $("#id").val(id);
                    }
                }
            })
        })
    </script>
@endsection
