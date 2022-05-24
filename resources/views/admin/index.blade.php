@extends('template.layouts.app')

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h2 class="mb-4">Admin</h2>

                        <div id="success_message"></div>

                        {{-- <a class="btn btn-primary" href="javascript:void(0)" id="addAdmin"> Tambah </a> --}}
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdmin"> Tambah </button>

                        <br><br>
                        @csrf
                        <table class="table table-bordered datatables">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th>Perusahaan</th>
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

{{-- <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="AdminForm" name="AdminForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label"> Name </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama admin..." value="" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label"> User Name </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." value="" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label"> Password </label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password..." value="" maxlength="50" required>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create"> Simpan </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul id="saveForm_errList"></ul>

            <div class="form-group">
                <label name="name" class="col-sm-4 control-label"> Nama </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..."  maxlength="50" required>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-4 control-label"> User Name </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..."  maxlength="50" required>
                </div>
            </div>

            <div class="form-group">
                <label for="company_id" class="col-sm-4 control-label"> Perusahaan </label>
                <select class="form-control" id="company_id" name="company_id">
                    @foreach ($companies as $company)
                        @if($company->deletedBy == '')
                            <option value={{ $company->id }}>{{ $company->companyName }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-4 control-label"> Password </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan password..." maxlength="50" value="" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary create">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="updateAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <ul id="saveForm_errList"></ul>
            <input type="text" id="id" name="id">
            <div class="form-group">
                <label name="name" class="col-sm-4 control-label"> Update Nama </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..."  maxlength="50" required>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-4 control-label"> Update User Name </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..."  maxlength="50" required>
                </div>
            </div>

            <div class="form-group">
                <label for="company_id" class="col-sm-4 control-label"> Perusahaan </label>
                <select class="form-control" id="company_id" name="company_id">
                    @foreach ($companies as $company)
                        @if($company->deletedBy == '')
                            <option value={{ $company->id }} selected>{{ $company->companyName }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-4 control-label"> Update Password </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Masukkan password..." maxlength="50" value="" required>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary update">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Hapus Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4>Yakin menghapus data?</h4>
            <input type="hidden" id="id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger delete">Hapus</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

{{-- <div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Yakin menghapus data?</b></p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                    Data</button>
            </div>
        </div>
    </div>
</div> --}}

<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.datatables').DataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('addAdmin.index') }}",
            method: 'GET',
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'companies.companyName', name: 'companies.companyName'},
                {data: 'action', name: 'action', width: '10%'},
            ],
            order: [
                [0, 'desc'],
            ],
            retrieve: true,
        });
    });

    $(document).ready(function (){
        $(document).on('click', '.create', function (e){
            // e.preventDefault();
            e.preventDefault();
            // console.log();
            var data = {
                'name': $('#name').val(),
                'username': $('#username').val(),
                'password': $('#password').val(),
                'company_id': $('#company_id').val(),
            };
            // console.log(data);

            $.ajax({
                type: "POST",
                url: "{{ route('addAdmin.store') }}",
                data: data,
                dataType: "json",
                success: function (response){
                    if(response.status == 400)
                    {
                        $('#saveForm_errList').html("");
                        $('#saveForm_errList').addClass('alert alert-danger');
                        $.each(response.errors, function (key, err_values) {
                            $('#saveForm_errList').append('<li>'+err_values+'</li>');
                        });
                    }
                    else if(response.status == 200)
                    {
                        $('#saveForm_errList').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.messages);
                        $("#addAdmin").modal('hide');
                        $("#addAdmin").find('input').val("");
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        });
    });

    $(document).on('click', '.deleteAdmin', function () {
        id = $(this).attr('id');
        $('#deleteAdmin').modal('show');
        $('#id').val(id);

        $('.delete').click(function () {
            $.ajax({
                url: "addAdmin/" + id,
                type: "PUT",
                dataType: "json",
                success:function (response) {
                    $('#deleteAdmin').modal('hide');
                    var table = $('.datatables').DataTable();
                    table.ajax.reload();
                }
            })
        })
    });

</script>

@endsection
