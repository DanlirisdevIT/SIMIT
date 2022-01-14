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
                        <label name="category_type" class="col-sm-4 control-label"> Tipe Kategori </label>
                        <select class="form-control" id="category_type" name="category_type">
                            <option value=""> -- Pilih Tipe Kategori -- </option>
                            <option value="Asset"> Asset </option>
                            <option value="Consumable"> Consumable </option>
                            <option value="Component"> Component </option>
                            <option value="License"> License </option>
                            <option value="Accesoris>"> Accesoris </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="addedForm"></div>
                    </div>

                    {{-- <div class="form-group">
                        <label name="category_time" class="col-sm-4 control-label"> Item Kategori </label>
                        <select class="form-control" id="category_item" name="category_item">
                            <option value=""></option>
                        </select>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label name="category_name" class="col-sm-4 control-label"> Nama </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Masukkan nama category..."  maxlength="50" required>
                        </div>
                    </div> --}}
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

            $('#category_type').on('change', function() {
                // var asset_item = ["Laptop", "PC", "Camera", "Scanner", "Printer"];
                // var component_item = ["PowerSupply", "Processor", "Motherboard"];
                // var consumable_item = ["RefillTinta", "CatridgeTinta"];

                var category_type = $('#category_type').val();

                console.log(category_type)

                if(category_type === "Asset") {
                    // $.each(asset_item, function(key, value){
                        dropdown = '<label name="category_time" class="col-sm-4 control-label"> Item Kategori </label>';
                        dropdown = dropdown + '<select class="form-control" id="category_item" name="category_item">';
                        dropdown = dropdown + '</select>';

                        var showForm = $('.addedForm').html(dropdown);

                        var option_component =
                        '<option value = "Laptop" selected> Laptop </option>'
                        +'<option value = "PC"> PC </option>'
                        +'<option value = "Camera"> Camera </option>'
                        +'<option value = "Scanner"> Scanner </option>'
                        +'<option value = "Printer"> Printer </option>'
                        +'<option value = "LCD Proyektor"> LCD Proyektor </option>'
                        +'<option value = "Monitor"> Monitor </option>'
                        +'<option value = "Wacom"> Wacom </option>'
                        +'<option value = "CCTV"> CCTV </option>'
                        +'<option value = "Switch"> Switch </option>'
                        +'<option value = "Speaker"> Speaker </option>'
                        +'<option value = "WIFI"> WIFI </option>';
                        $('select[name="category_item"]').append(option_component)
                        showForm.show()
                    // });
                }
                else if(category_type === "Component") {
                    dropdown = '<label name="category_time" class="col-sm-4 control-label"> Item Kategori </label>'
                    dropdown = dropdown + '<select class="form-control" id="category_item" name="category_item">';
                    dropdown = dropdown + '</select>';

                    var showForm = $('.addedForm').html(dropdown);

                    var option_component =
                    '<option value = "Power Supply" selected> Power Supply </option>'
                    +'<option value = "Processor"> Processor </option>'
                    +'<option value = "Motherboard"> Motherboard </option>'
                    +'<option value = "Casing"> Casing </option>'
                    +'<option value = "Harddisk"> Harddisk </option>'
                    +'<option value = "RAM"> RAM </option>'
                    +'<option value = "Fan Processor"> Fan Processor </option>'
                    +'<option value = "DVD Internal"> DVD Internal </option>'
                    +'<option value = "CPU"> CPU </option>'
                    +'<option value = "Kabel"> Kabel </option>'
                    +'<option value = "Mouse"> Mouse </option>'
                    +'<option value = "Keyboard"> Keyboard </option>';
                    $('select[name="category_item"]').append(option_component);
                    showForm.show()
                }
                else if(category_type === "Consumable") {
                    dropdown = '<label name="category_time" class="col-sm-4 control-label"> Item Kategori </label>'
                    dropdown = dropdown + '<select class="form-control" id="category_item" name="category_item">';
                    dropdown = dropdown + '</select>';

                    var showForm = $('.addedForm').html(dropdown);

                    var option_component =
                    '<option value = "Refil Tinta" selected> Refil Tinta </option>'
                    + '<option value = "Catridge Tinta"> Catridge Tinta </option>'
                    + '<option value = "Catridge Toner"> Catridge Toner </option>'
                    + '<option value = "Catridge"> Catridge </option>';
                    $('select[name="category_item"]').append(option_component);
                    showForm.show()
                }
                else if(category_type === "License" || category_type === "Accesoris"){
                    var form = '<label name="category_name" class="col-sm-4 control-label"> Nama </label>';
                        form = form +'<div class="col-sm-12">';
                        form = form +'<input type="text" class="form-control" id="category_name" name="category_name" placeholder="Masukkan nama category..."  maxlength="50" required>';
                        form = form +'</div>';
                    var showForm = $(".addedForm").html(form);
                    showForm.show();
                }
            })

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
