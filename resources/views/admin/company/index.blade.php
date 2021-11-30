@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">List Perusahaan</h2>

                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompany"> Tambah </button> --}}

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addCompany">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
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

    <div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Nama Perusahaan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="saveForm_errList"></ul>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="companyName" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Masukkan nama perusahaan..."  maxlength="50" required>
                        </div>
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

    <div class="modal fade" id="updateCompany" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Nama Perusahaan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="updateForm_errList"></ul>
                <form id="CompanyForm" name="CompanyForm" class="form-horizontal">
                    <input type="hidden" id="id">
                    <div class="EditCompanyBody">

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                <button type="button" class="btn btn-primary update">Perbaharui</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="deleteCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
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
                ajax: "{{ route('company.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'companyName', name: 'companyName'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });

        $(document).ready(function () {
            $(".reset").click( function(){
                $('#company_name').val("");
            });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'companyName': $('#companyName').val(),
                }

                $(this).removeData();

                $.ajax({
                    type: "POST",
                    url: "{{ route('company.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response){
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
                            $('#addCompany').modal('hide');
                            // $('#addCompany').modal('show');
                            $('#addCompany').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                        }
                    }
                });
            });
        });

        $(document).on('click', '.editCompany', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#updateCompany').modal('show');

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('company.index') }}" + '/' + id + '/edit',
                success: function (response) {
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editCompany').modal('hide');
                    }
                    else
                    {
                        $('.EditCompanyBody').html(response.html)
                        $(".reset-update").click( function(){
                            $('.EditCompanyBody').find('#companyName').val("");
                        });
                        $("#companyName").html(response.companies['companyName']);
                        console.log(response.companies['companyName'])
                        $("#id").val(id);
                    }
                }
            });
        });

        $(document).on('click', '.update', function (e) {
            e.preventDefault();

            $(this).text("Memperbaharui...");

            var id = $('#id').val();

            console.log(id)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/company/" + id,
                method: 'PUT',
                data: $('#CompanyForm').serialize(),
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
                        $('#updateCompany').find("input").val('');
                        $('.update').text('update');
                        $('#updateCompany').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        })

        $(document).on('click', '.deleteCompany', function () {
            id = $(this).attr('id');
            companyName = $(this).attr('name');
            console.log(id)
            $('#deleteCompany').modal('show');
            $('#id').val(id);

            show = "<h5> Nama Perusahaan : <b>" + companyName + "</b><h5>";

            $('.show-data').html(show);

            $('.delete').click(function () {
                $.ajax({
                    url: "company/" + id,
                    type: "DELETE",
                    dataType: "json",
                    success:function (response) {
                        $('#deleteCompany').modal('hide');
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                    }
                })
            })
        });

    });

    </script>

@endsection

