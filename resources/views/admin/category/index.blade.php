@extends('template.layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h2 class="mb-4">List Kategori</h2>

                            <button style="float: right; font-weight: 900;" class="btn btn-info" type="button"  data-toggle="modal" data-target="#addCategory">
                                Tambah
                            </button>

                            <br><br>
                            @csrf
                            <table class="table table-bordered datatables">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tipe Kategori</th>
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

    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Kategori</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="saveForm_errList"></ul>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="category_name" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Masukkan nama category..."  maxlength="50" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>
                        <select class="form-control" id="category_type">
                            <option value="Asset" selected="selected"> Asset </option>
                            <option value="Consumable"> Consumable </option>
                            <option value="Component"> Component </option>
                            <option value="License"> License </option>
                            <option value="Accesoris>"> Accesoris </option>
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

    <div class="modal fade" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Kategori</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="updateForm_errList"></ul>
                <form id="CategoryForm" name="CategoryForm" class="form-horizontal">
                    <input type="hidden" id="id">
                    <div class="EditCategoryBody">

                    </div>
                </form>
            </div>
            {{-- konfirmasi hapus data --}}
            <div class="col-md-12 col-sm-12 col-xs-12 deleteConfirm"></div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> --}}
                <button type="button" class="btn btn-outline-secondary reset-update">Reset</button>
                <button type="button" class="btn btn-primary update">Perbaharui</button>
                <button type="button" class="btn btn-danger deleteCategory"><i class="far fa-trash-alt"></i></button>
            </div>
          </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                ajax: "{{ route('category.index') }}",
                method: 'GET',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'category_type', name: 'category_type'},
                    {data: 'action', name: 'action', width: '10%'},
                ],
                order: [
                    [0, 'desc'],
                ],
            });

            $(".reset").click( function(){
                $('#category_name').val("");
                $('#category_type').val($('#category_type').data("default-value"));
            });

            $(document).ready(function () {
                $(document).on('click', '.create', function (e) {
                    e.preventDefault();

                    var data = {
                        'category_name': $('#category_name').val(),
                        'category_type': $('#category_type').val(),
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('category.store') }}",
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
                                $('#addCategory').modal('hide');
                                $('#addCategory').find('input').val("");
                                $('.modal-backdrop').remove();
                                var table = $('.datatables').DataTable();
                                table.ajax.reload();
                            }
                        }
                    });
                });

                $(document).on('click', '.editCategory', function (e) {
                    e.preventDefault();

                    var id = $(this).data('id');

                    $('#updateCategory').modal('show');

                    console.log(id);

                    $.ajax({
                        type: "GET",
                        url: "{{ route('category.index') }}" + '/' + id + '/edit',
                        success: function (response) {
                            if (response.status == 404) {
                                $('#updateForm_errList').addClass('alert alert-success');
                                $('#updateForm_errList').text(response.message);
                                $('.editCategory').modal('hide');
                            }
                            else
                            {
                                $('.EditCategoryBody').html(response.html)
                                $(".reset-update").click( function(){
                                    $('.EditCategoryBody').find('#category_name').val("");
                                    $('.EditCategoryBody').find('#category_type').val("seletedIndex", 0); //get 1 optiion
                                });
                                $("#category_name").html(response.categories['category_name']);
                                $("#category_type").html(response.categories['category_type']);
                                console.log(response.categories['category_name'])
                                console.log(response.categories['category_type'])
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
                        url: "/category/" + id,
                        method: 'PUT',
                        data: $('#CategoryForm').serialize(),
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
                                $('#updateCategory').find('input').val('');
                                $('.update').text('update');
                                $('#updateCategory').modal('hide');
                                $('.modal-backdrop').remove();
                                var table = $('.datatables').DataTable();
                                table.ajax.reload();
                            }
                        }
                    })
                });

                $(document).on('click', '.deleteCategory', function () {
                    // id = $(this).attr('id');
                    // category_name = $(this).attr('name');
                    // category_type = $(this).attr('type');
                    // console.log(id)
                    // $('#deleteCategory').modal('show');
                    // $('#id').val(id);

                    // show = "<h5> Nama Kategori: <b>" + category_name + "</b> <br></br> Tipe Kategori : <b>" +category_type+ "</b><h5>";

                    // $('.show-data').html(show);

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
                            url: "category/" + id,
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
                                    $('#updateCategory').modal('hide');
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
