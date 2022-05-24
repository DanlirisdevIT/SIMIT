@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Unit</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addUnit">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Nama Divisi</th>
                                        <th>Nama Company</th>
                                        <th>Nama Lokasi</th>
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

    <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Tambah Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <ul id="saveForm_errList"></ul>
                        <form id="upload" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label name="unit_name" class="col-sm-4 control-label"> Nama </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Masukkan nama Unit..."  maxlength="50" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label name="division_id" class="col-sm-4 control-label"> Pilih Divisi </label>
                                <select class="form-control" id="division_id" name="division_id">
                                    <option value="">Pilih  divisi----</option>
                                    @foreach ($divisions as $division)
                                        @if ($division->deletedBy == '')
                                            <option value={{ $division->id }}>{{$division->division_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label name="company_id" class="col-sm-4 control-label"> Pilih Company </label>
                                <select class="form-control" id="company_id" name="company_id">
                                    <option value="">Pilih  company----</option>
                                    @foreach ($companies as $company)
                                        @if ($company->deletedBy == '')
                                            <option value={{ $company->id }}>{{$company->companyName}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label name="location_id" class="col-sm-4 control-label"> Pilih Lokasi </label>
                                <select class="form-control" id="location_id" name="location_id">
                                    <option value="">Pilih  lokasi----</option>
                                    @foreach ($locations as $location)
                                        @if ($location->deletedBy == '')
                                            <option value={{ $location->id }}>{{$location->location_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset">Reset</button>
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                    <button type="button" class="btn btn-primary create">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateUnit" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Unit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="updateUnitForm" action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <ul id="updateForm_errList"></ul>
                    <input type="hidden" id="id">

                    <div class="form-group">
                        <label name="unit_name" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Masukkan nama Unit..."  maxlength="50" required>
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
                        <label name="company_id" class="col-sm-4 control-label"> Pilih Company </label>
                        <select class="form-control" id="company_id" name="company_id">
                            @foreach ($companies as $company)
                                @if ($company->deletedBy == '')
                                    <option value={{ $company->id }}>{{$company->companyName}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label name="location_id" class="col-sm-4 control-label"> Pilih Lokasi </label>
                        <select class="form-control" id="location_id" name="location_id">
                            @foreach ($locations as $location)
                                @if ($location->deletedBy == '')
                                    <option value={{ $location->id }}>{{$location->location_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                    <button type="button" class="btn btn-primary update">Perbaharui</button>
                    <button type="button" class="btn btn-danger deleteUnit"><i class="far fa-trash-alt"></i></button>
                </div>
            </form>
          </div>
        </div>
    </div>

    <div class="modal fade" id="deleteUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Hapus Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <div class="show-data">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger delete">Hapus Data?</button>
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
                ajax: "{{ route('unit.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'unit_name', name: 'unit_name', width: '15%'},
                    {data: 'divisions.division_name', name: 'divisions.division_name', width: '15%'},
                    {data: 'companies.companyName', name: 'companies.companyName', width: '15%'},
                    {data: 'locations.location_name', name: 'categories.location_name', width: '15%'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });
        });

        //create/post/store
        $(document).ready(function () {
            $(".reset").click( function(){
                $('#unit_name').val("");
            });
            $(document).on('click', '.create', function (e) {
                e.preventDefault();
                let formData = new FormData($('#upload')[0]);
                console.log(formData);

                $.ajax({
                    type: "POST",
                    url: "{{ route('unit.store') }}",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status == 400){
                            $('#saveForm_errList').html("");
                            $('#saveForm_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values) {
                                $('#saveForm_errList').append('<li>'+err_values+'</li>');
                            });
                        }else if(response.status == 200)
                        {
                            $('#saveForm_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.messages);
                            $('#addUnit').modal('hide');
                            // $('#addCompany').modal('show');
                            $('#addUnit').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                        }
                    }
                });
            });
        });

        //edit/update
        $(document).on('click', '.editUnit', function (e){

            e.preventDefault();

            var id = $(this).data('id');

            $('#updateUnit').modal('show');

            $.ajax({
                type: "GET",
                url: "{{ route('unit.index') }}" + '/' + id + '/edit',
                success: function(response){
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editUnit').modal('hide');
                    }
                    else
                    {
                        $('#btnDelete').html(response.html)
                        $(".reset-update").click( function(){
                            $('#updateUnitForm').find('#unit_name').val("");
                            $('#updateUnitForm').find('#division_id').val("selectedIndex", 0);
                            $('#updateUnitForm').find('#company_id').val("selectedIndex", 0);
                            $('#updateUnitForm').find('#location_id').val("selectedIndex", 0);
                        });
                        $("#id").val(id);
                        $('#updateUnit').find("#unit_name").val(response.units.unit_name);
                        var option_division = '<option value = "'+response.divisions.id+'" selected> --- '+response.divisions.division_name+' --- </option>'
                        $('#updateUnit').find('select[name="division_id"]').append(option_division);

                        var option_company = '<option value = "'+response.companies.id+'" selected> --- '+response.companies.companyName+' --- </option>'
                        $('#updateUnit').find('select[name="company_id"]').append(option_company);

                        var option_location = '<option value = "'+response.locations.id+'" selected> --- '+response.locations.location_name+' --- </option>'
                        $('#updateUnit').find('select[name="location_id"]').append(option_location);
                        $('#updateUnit').find('input[type="file"]').val('');
                    }
                }
            })
        });

        $(document).on('click', '.update', function(e) {
            e.preventDefault();

            $(this).text('Memperbaharui...');

            var id = $('#id').val();
            console.log(id)

            let formData = new FormData($('#updateUnitForm')[0]);
            console.log(formData)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/unit/" + id,
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
                        $('#updateUnit').find('input').val('');
                        $('.update').text('update');
                        $('#updateUnit').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload(); //untuk auto refresh halaman
                    }
                }
            })
        })

        $(document).on('click', '.deleteUnit', function () {
            // id = $(this).attr('id');
            // unit_name = $(this).attr('unit_name');
            // console.log(id)
            // $('#deleteUnit').modal('show');
            // $('#id').val(id);

            // show = "<h5> Nama Unit: <b>" + unit_name + "</b><h5>";;

            // $('.show-data').html(show);

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
                    url: "unit/" + id,
                    type: "DELETE",
                    dataType: "json",
                    success:function (response) {
                        // $('#deleteUnit').modal('hide');
                        // var table = $('.datatables').DataTable();
                        // table.ajax.reload();
                        $('#updateManufacture').modal('hide');
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                        location.reload();
                    }
                })
            })
        });

    </script>
@endsection
