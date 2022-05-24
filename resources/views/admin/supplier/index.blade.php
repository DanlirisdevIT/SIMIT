@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">Supplier</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addSupplier">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Nama Agen</th>
                                        <th>Tipe Partner</th>
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

    <div class="modal fade" id="addSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Supplier</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="saveForm_errList"></ul>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="supplier_name" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="supplier_name" name="supplier_name" placeholder="Masukkan nama supplier..."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="address" class="col-sm-4 control-label"> Alamat </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="address" name="address" placeholder="Masukkan alamat..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="phone" class="col-sm-4 control-label"> No Telp </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Masukkan no telp..."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="agent_name" class="col-sm-4 control-label"> Nama Agen </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="agent_name" name="agent_name" placeholder="Masukkan nama agen..."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="partner_type" class="col-sm-4 control-label"> Tipe Partner </label>
                        <select class="form-control" id="partner_type">
                            <option value="Partnership" selected="selected"> Partnership </option>
                            <option value="General Partnership"> General Partnership </option>
                            <option value="Limited Partnership"> Limited Partnership </option>
                        </select>
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

    <div class="modal fade" id="updateSupplier" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Supplier</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="updateForm_errList"></ul>
                <form id="SupplierForm" name="SupplierForm" class="form-horizontal">
                    <input type="hidden" id="id">
                    <div class="EditSupplierBody">

                    </div>
                </form>
            </div>
            {{-- konfirmasi hapus data --}}
            <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                <button type="button" class="btn btn-primary update">Perbaharui</button>
                <button type="button" class="btn btn-danger deleteSupplier"><i class="far fa-trash-alt"></i></button>
            </div>
          </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="deleteSupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                ajax: "{{ route('supplier.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'supplier_name', name: 'supplier_name'},
                    {data: 'address', name: 'address'},
                    {data: 'phone', name: 'phone'},
                    {data: 'agent_name', name: 'agent_name'},
                    {data: 'partner_type', name: 'partner_type'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });

            $(".reset").click( function(){
                $('#supplier_name').val("");
                $('#address').val("");
                $('#phone').val("");
                $('#agent_name').val("");
                $('#partner_type').val($('#partner_type').data("default-value"));
            });

            $(document).ready(function () {
                $(document).on('click', '.create', function (e) {
                    e.preventDefault();

                    var data = {
                        'supplier_name': $('#supplier_name').val(),
                        'address': $('#address').val(),
                        'phone': $('#phone').val(),
                        'agent_name': $('#agent_name').val(),
                        'partner_type': $('#partner_type').val(),
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('supplier.store') }}",
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
                                $('#addSupplier').modal('hide');
                                $('#addSupplier').find('input').val("");
                                $('.modal-backdrop').remove();
                                var table = $('.datatables').DataTable();
                                table.ajax.reload();
                            }
                        }
                    });
                });

                $(document).on('click', '.editSupplier', function (e) {
                    e.preventDefault();

                    var id = $(this).data('id');

                    $('#updateSupplier').modal('show');

                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('supplier.index') }}" + '/' + id + '/edit',
                        success: function (response) {
                            if (response.status == 404) {
                                $('#updateForm_errList').addClass('alert alert-success');
                                $('#updateForm_errList').text(response.message);
                                $('.editSupplie').modal('hide');
                            }
                            else
                            {
                                $('.EditSupplierBody').html(response.html)
                                $(".reset-update").click( function(){
                                    $('.EditSupplierBody').find('#supplier_name').val("");
                                    $('.EditSupplierBody').find('#address').val("");
                                    $('.EditSupplierBody').find('#phone').val("");
                                    $('.EditSupplierBody').find('#agent_name').val("");
                                    $('.EditSupplierBody').find('#partner_type').val("seletedIndex", 0); //get 1 optiion
                                });
                                $("#supplier_name").html(response.suppliers['supplier_name']);
                                $("#address").html(response.suppliers['address']);
                                $("#phone").html(response.suppliers['phone']);
                                $("#agent_name").html(response.suppliers['agent_name']);
                                $("#partner_type").html(response.suppliers['partner_type']);
                                console.log(response.suppliers['supplier_name'])
                                console.log(response.suppliers['address'])
                                console.log(response.suppliers['phone'])
                                console.log(response.suppliers['agent_name'])
                                console.log(response.suppliers['partner_type'])
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
                        url: "/supplier/" + id,
                        method: 'PUT',
                        data: $('#SupplierForm').serialize(),
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
                                $('#updateSupplier').find('input').val('');
                                $('.update').text('update');
                                $('#updateSupplier').modal('hide');
                                $('.modal-backdrop').remove();
                                var table = $('.datatables').DataTable();
                                table.ajax.reload();
                            }
                        }
                    })
                });

                $(document).on('click', '.deleteSupplier', function () {
                    var id = $('#id').val();
                    console.log(id)

                    show = '<div class="col-md-12">';
                    show = show+'<div class="card mb-3 box-shadow"><div class="card-body"><h5>';
                    show = show+'Ingin menghapus data ini?';
                    show = show+'<button style="float: right; font-weight: 900;" type="button" class="btn btn-danger delete">Hapus Data?</button>';
                    show = show+'</h5></div></div></div>';

                    // show dan hide konfirmasi by click
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
                            url: "supplier/" + id,
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
                                    $('#updateSupplier').modal('hide');
                                    var table = $('.datatables').DataTable();
                                    table.ajax.reload();
                                    location.reload();
                                }
                            }
                        })
                    })
                });
            });

        });
    </script>

@endsection
