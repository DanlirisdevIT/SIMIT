@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">List Lokasi</h2>

                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCompany"> Tambah </button> --}}

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addLocation">
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

    <div class="modal fade" id="addLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Nama Lokasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="saveForm_errList"></ul>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="location_name" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Masukkan nama lokasi..."  maxlength="50" required>
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

    <div class="modal fade" id="updateLocation" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Nama Lokasi</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="updateForm_errList"></ul>
                <form id="LocationForm" name="LocationForm" class="form-horizontal">
                    <input type="hidden" id="id">
                    <div class="EditLocationBody">

                    </div>
                </form>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                <button type="button" class="btn btn-primary update">Perbaharui</button>
                <button type="button" class="btn btn-danger deleteLocation"><i class="far fa-trash-alt"></i></button>
            </div>
          </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="deleteLocation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger delete">Hapus Data?</button>
            </div>
          </div>
        </div>
    </div> --}}

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
                ajax: "{{ route('location.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'location_name', name: 'location_name'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });

        $(document).ready(function () {
            $(".reset").click( function(){
                $('#location_name').val("");
            });

            $(document).on('click', '.create', function (e) {
                e.preventDefault();

                var data = {
                    'location_name': $('#location_name').val(),
                }

                $(this).removeData();

                $.ajax({
                    type: "POST",
                    url: "{{ route('location.store') }}",
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
                            $('#addLocation').modal('hide');
                            $('#addLocation').find("input").val("");
                            $('.modal-backdrop').remove();
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                        }
                    }
                });
            });
        });

        $(document).on('click', '.editLocation', function (e) {
            e.preventDefault();

            var id = $(this).data('id');

            $('#updateLocation').modal('show');

            console.log(id);

            $.ajax({
                type: "GET",
                url: "{{ route('location.index') }}" + '/' + id + '/edit',
                success: function (response) {
                    if (response.status == 404) {
                        $('#updateForm_errList').addClass('alert alert-success');
                        $('#updateForm_errList').text(response.message);
                        $('.editLocation').modal('hide');
                    }
                    else
                    {
                        $('.EditLocationBody').html(response.html)
                        $(".reset-update").click( function(){
                            $('.EditLocationBody').find('#location_name').val("");
                        });
                        $("#location_name").html(response.locations['location_name']);
                        console.log(response.locations['location_name'])
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
                url: "/location/" + id,
                method: 'PUT',
                data: $('#LocationForm').serialize(),
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
                        $('#updateLocation').find("input").val('');
                        $('.update').text('update');
                        $('#updateLocation').modal('hide');
                        $('.modal-backdrop').remove();
                        var table = $('.datatables').DataTable();
                        table.ajax.reload();
                    }
                }
            })
        });

        $(document).on('click', '.deleteLocation', function () {
            // id = $(this).attr('id');
            // location_name = $(this).attr('name');
            // console.log(id)
            // $('#deleteLocation').modal('show');
            // $('#id').val(id);

            // show = "<h5> Nama Lokasi : <b>" + location_name + "</b><h5>";

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
                    url: "location/" + id,
                    type: "DELETE",
                    dataType: "json",
                    success:function (response) {
                        if(response.status == 400)
                        {
                            $('#updateForm_errList').html("");
                            $('#updateForm_errList').addClass('alert alert-danger');
                            $('#updateForm_errList').append('<li>'+response.messages+'</li>');
                        }
                        else
                        {
                            $('#updateLocation').modal('hide');
                            var table = $('.datatables').DataTable();
                            table.ajax.reload();
                            location.reload();
                            // $('#deleteLocation').modal('hide');
                            // var table = $('.datatables').DataTable();
                            // table.ajax.reload();
                        }
                    }
                })
            })
        });

    });

    </script>

@endsection

