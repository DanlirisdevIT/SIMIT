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
                                        <th>Permintaan UID</th>
                                        <th>User</th>
                                        <th>Divisi</th>
                                        <th>Perusahaan</th>
                                        <th>Kategori</th>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <!-- {{-- <th>Keterangan</th> --}} -->
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

            <form id="form" name="form" class="form-horizontal">
            <div class="modal-body" style="overflow:hidden;">
                <ul id="saveForm_errList"></ul>

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="date" class="col-sm-4 control-label"> Tanggal </label>
                        <div class="input-group mb-2">
                            <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal..." aria-label="date" aria-describedby="basic-addon1">
                            <!-- {{-- <div class="input-group-prepend">
                                <span class="input-group-text" id="date"><i class="fa fa-calendar-alt" id="date"></i></span>
                            </div> --}} -->
                        </div>
                    </div>
                </div>
                   
                <div class="form-group">
                    <!-- <div class="modal-body1">
                        <div class="form-group"> -->
                            <label name="username" class="col-sm-4 control-label"> User </label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        <!-- </div>
                    </div> -->
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
                        <select class="form-control select2" id="division_id" name="division_id" style="width: 100%;">
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
                    <!-- <form > -->
                    <div class="form-group">
                        <!-- <div class="input-group mb-8"> -->
                        <label name="category_id" class="col-sm-4 control-label"> Tambah Kategori</label>
                        <!-- <div class="input-group mb-4"> -->
                            <!-- <form id="form" name="form" class="form-horizontal"> -->
                                <select class="form-control select2" id="category_id" name="category_id" style="width: 100%;">
                                    @foreach ($categories as $category)
                                        @if($category->deletedBy == '')
                                            <option value={{ $category->id }}>{{$category->category_type}} - {{$category->category_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            <!-- </form> -->
                            <!-- <div class="new_form"></div> -->
                            <!-- <button class="btn btn-outline-secondary float-right add_category" type="button" id="button-addon2">Tambah</button> -->
                        <!-- </div> -->
                    </div>
                    
                </div>

                <!-- <div class="modal-body1">
                    <form id="form" name="form" class="form-horizontal">
                        <div class="input-group mb-4">
                            <div class="form-group">
                                <div id="new_form"></div>
                            </div>
                        </div>
                    </form>
                </div> -->

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

                <div class="modal-body1">
                    <div class="form-group">
                        <label name="description" class="col-sm-4 control-label"> Keterangan </label>
                        <div class="col-sm-12">
                            <textarea class="form-control" id="description" name="description" placeholder="Masukkan keterangan..."  maxlength="50" required></textarea>
                        </div>
                    </div>
                </div>

            </div>
            </form>
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
                ajax: "{{ route('danliris_permintaan.index') }}",
                method: 'GET',
                // type: "GET",
                // url: "{{ route('permintaan.index') }}" + '/' + 'getDanliris',
                destroy: true,
                columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                        {data: 'date', name: 'date', width: '15%' },
                        {data: 'dl_permintaan_uid', name: 'dl_permintaan_uid', width: '15%'},
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

        $('#category_id').select2({
            theme: 'bootstrap4'
        })

        $('#division_id').select2({
            theme: 'bootstrap4'
        })

        // $('.add_category').click(function(){

            // function get_categories()
            // {
            //     $.ajax({
            //         url: "{{ route('danliris_permintaan.create') }}",
            //         type: "GET",
            //         dataType: "json",
            //         success: function(response)
            //         {
            //             if(response.status == 200)
            //             {
                            
            //                 var categories = response.categories;

            //                 var assets = response.assets;

            //                 category(categories)

            //                 asset(assets)
            //             }
            //         }
            //     })
            // }

            // get_categories();

            // function category(categories)
            // {
            //     var html = '<div class = "form-group">'
            //     html += '<select class="form-control" id="category_id" name="category_id[]">'
            //     $.each(categories, function(index, categories) {
            //         html += '<option value="'+categories.id+'">'+categories.category_type+' - '+categories.category_name+'</option>'
            //     })
            //     html += '</select>'
            //     html += '</div>'

            //     $('#new_category').append(html);
            // }

            // function asset(assets)
            // {
            //     var html = '<div class = "form-group">'
            //     html += '<select class="form-control" id="asset_id" name="asset_id[]">'
            //     $.each(assets, function(index, assets) {
            //         html += '<option value="'+assets.id+'">'+assets.asset_name+'</option>'
            //     })
            //     html += '</select>'
            //     html += '</div>'

            //     $('#new_asset').append(html);
            // }

            // var html = '<button class="btn btn-outline-danger float-right remove_category" type="button" id="button-addon2">Remove</button>'
            // $('#btn-remove').append(html);

        // });

        // const add = document.querySelectorAll(".input-group .add_category")
        // add.forEach(function (e) {
        //     e.addEventListener('click', function() {
        //         let element = this.parentElement

        //         var tmp;

        //         var get_categories = function() {
        //             // var tmp;
        //                 $.ajax({
        //                     async: false,
        //                     url: "{{ route('danliris_permintaan.create') }}",
        //                     type: "GET",
        //                     dataType: "json",
        //                     success: function(response)
        //                     {
        //                         if(response.status == 200)
        //                         {
        //                             tmp = response.categories;
        //                             // category(categories);
        //                         }
        //                     }
        //                 })

        //             return tmp; 
        //         }();

        //         // get_categories()

        //         let newElement = document.createElement('div')
        //         newElement.classList.add('.input-group', 'mb-2')
        //         newElement.innerHTML = '<div class="form-group">';
        //         newElement.innerHTML = newElement.innerHTML + '<select class="form-control" id="category_id" name="category_id[]">';
        //         newElement.innerHTML = newElement.innerHTML + '<option value="'+tmp.id+'">'+tmp.category_type+' - '+tmp.category_name+'</option>';
        //         // $.each(tmp, function(index, tmp) {
        //         //     $('select[name="category_id[]"]').appendChild('<option value="'+tmp.id+'">'+tmp.category_type+' - '+tmp.category_name+'</option>')
        //         // })
        //         newElement.innerHTML = newElement.innerHTML + '</select>';
        //         newElement.innerHTML = newElement.innerHTML + '</div>';

        //         newElement.innerHTML = newElement.innerHTML + '<div class="form-group">'
        //         newElement.innerHTML = newElement.innerHTML + '<button class="btn btn-outline-danger float-right remove_category" type="button" id="button-addon2">Remove</button>'
        //         newElement.innerHTML = newElement.innerHTML + '</div>'
                
        //         var len = 0;

        //         if(tmp != null)
        //         {
        //             len = tmp.length;
        //         }
        //         if(len > 0)
        //         {
        //             for(var i=0; i<len; i++)
        //             {
        //                 var id= tmp[i].id;
        //                 var name= tmp[i].category_name;
        //                 var type= tmp[i].category_type;
                        
        //                 console.log(name)

        //                 var option = '<option value='+id+'>'+type+' - '+name+'</option>'
                        
        //                 $('select[name="category_id[]"]').append(option);
        //             }
        //         }

        //         document.getElementById('new_form').appendChild(newElement)

        //         document.querySelector('form').querySelectorAll('.remove_category').forEach(function (remove) {
        //             remove.addEventListener('click', function(click) {
        //                 click.target.parentElement.remove();
        //             })
        //         })
        //     })
        // })

        // document.getElementById( 'button-addon2' ).addEventListener( 'click', function ( event ) {

        //     event.preventDefault();
        //     var select = document.getElementById( 'category_id' ).cloneNode( true );
        //     document.getElementById( 'form' ).appendChild( select );

        // }, false );

        // const add = document.querySelectorAll(".input-group .add_category")
        // add.forEach(function(e){
        //     e.addEventListener('click', function() {
        //         let element = this.parentElement;
        //         console.log(element)
        //         let newElement = document.createElement('div');
        //         newElement.classList.add('.input-group', 'mb-4')
        //         newElement.innerHTML = '<div class="form-group">';
        //         newElement.innerHTML = newElement.innerHTML + '<select class="form-control" id="category_id" name="category_id">';
        //         newElement.innerHTML = newElement.innerHTML + '</select>';
        //         newElement.innerHTML = newElement.innerHTML + '</div>';

        //         // let newElementAsset = document.createElement('div')
        //         newElement.classList.add('.input-group', 'mb-4')
        //         newElement.innerHTML = newElement.innerHTML + '<div class="form-group">';
        //         newElement.innerHTML = newElement.innerHTML + '<select class="form-control" id="asset_id" name="asset_id">';
        //         newElement.innerHTML = newElement.innerHTML + '</select>';
        //         newElement.innerHTML = newElement.innerHTML + '</div>';
        //         // newElementAsset.innerHTML = newElementAsset.innerHTML + '<button class="btn btn-outline-danger remove_category" type="button" id="button-addon2">Remove</button>';

        //         // let newElementQty = document.createElement('div')
        //         newElement.classList.add('.input-group', 'mb-4')
        //         newElement.innerHTML = newElement.innerHTML + '<div class="form-group">';
        //         newElement.innerHTML = newElement.innerHTML + '<input type="number" class="form-control" id="quantity" name="quantity" placeholder="jumlah..." maxlength="50">';
        //         newElement.innerHTML = newElement.innerHTML + '</div>';
        //         newElement.innerHTML = newElement.innerHTML + '<div class="form-group">';
        //         newElement.innerHTML = newElement.innerHTML + '<button class="btn btn-outline-danger float-right remove_category" type="button" id="button-addon2">Remove</button>';
        //         newElement.innerHTML = newElement.innerHTML + '</div>';

        //         document.getElementById('new_form').appendChild(newElement)
        //         // document.getElementById('new_asset').appendChild(newElementAsset)
        //         // document.getElementById('new_qty').appendChild(newElementQty)
        //         // document.getElementById('btn-remove').appendChild(newElementQty)
        //         console.log(newElement)

        //         document.querySelector('form').querySelectorAll('.remove_category').forEach(function (remove) {
        //             remove.addEventListener('click', function(click) {
        //                 click.target.parentElement.remove();
        //             })
        //         })

        //         // var getElementCategory = document.querySelector(newElement)

        //         // getCategories(getElementCategory);
        //     })
        // })

        // $.ajax({
        //     url: "{{ route('danliris_permintaan.create') }}",
        //     type: "GET",
        //     dataType: "json",
        //     success: function(response)
        //     {
        //         if(response.status == 200)
        //         {
        //             var sel = document.getElementById('category_id')
        //             var opt = null;

        //             for(let i=0; i<response.categories.length; i++)
        //             {
        //                 opt = document.createElement('option');
        //                 opt.value = response.categories[i].id;
        //                 opt.innerHTML = response.categories[i].name;
        //                 sel.appendChild(opt);
        //             }
        //         }
        //     }
        // })

        // function getCategories(getElementCategory)
        // {
            // $.ajax({
            //     url: "{{ route('danliris_permintaan.create') }}",
            //     type: "GET",
            //     dataType: "json",
            //     success: function(response)
            //     {
            //         if(response.status == 200)
            //         {
                        // $.each(response.categories, function(index, categories) {
                        //     $('select[name="category_id"]').append('<option value="'+categories.id+'">'+categories.category_type+' - '+categories.category_name+'</option>')
                            
                        //     $(this).siblings('[value="'+this.categories+'"]').remove()
                        // })

                        // $.each(response.categories, function(index, categories) {
                        //     $('select[name="category_id"]').append($('<option></option>').attr("categories", index).text(categories));
                        // })
                        
                        // $.each(response.assets, function(index, assets) {
                        //     $('select[name="asset_id"]').html('<option value="'+assets.id+'">'+assets.asset_name+'</option>')
                        // })

                        // $.each(response.categories, function(index, categories) {
                        //     var selected = false;
                        //     for(var i=0; i<categories.length; i++){
                        //         selected = true;
                        //         break;
                        //     }

                        //     $('select[name="category_id"]').append('<option value="'+categories.id+'">'+categories.category_type+' - '+categories.category_name+'</option>')
                        
                        //     var map = {};

                        //     if(map[this.categories]) {
                        //         $(this).remove();
                        //     }
                        //     map[this.categories] = true;
                            
                        // })
            //         }
            //     }
            // })
        // }

        // const addAsset = document.querySelectorAll(".input-group .add_category")
        // addAsset.forEach(function(e) {
        //     e.addEventListener('click', function() {
        //         let element = this.parentElement
        //         console.log(element)

        //         let newElementAsset = document.createElement('div')
        //         newElementAsset.classList.add('.input-group', 'mb-4')
        //         newElementAsset.innerHTML = '<div class="form-group">';
        //         newElementAsset.innerHTML = newElementAsset.innerHTML + '<select class="form-control" id="asset_id" name="asset_id">';
        //         newElementAsset.innerHTML = newElementAsset.innerHTML + '</select>';
        //         newElementAsset.innerHTML = newElementAsset.innerHTML + '</div>';

        //         $.ajax({
        //             url: "{{ route('danliris_permintaan.create') }}",
        //             type: "GET",
        //             dataType: "json",
        //             success: function(response)
        //             {
        //                 if(response.status == 200)
        //                 {
        //                     $.each(response.categories, function(index, categories) {
        //                         $('select[name="category_id[]"]').html('<option value="'+categories.id+'">'+categories.category_type+' - '+categories.category_name+'</option>')
        //                     })
                            
        //                     $.each(response.assets, function(index, assets) {
        //                         $('select[name="asset_id"]').html('<option value="'+assets.id+'">'+assets.asset_name+'</option>')
        //                     })
        //                 }
        //             }
        //         })

        //         document.getElementById('new_asset').appendChild(newElementAsset)
        //         console.log(newElementAsset)
        //     })
        // })

        // $.ajax({
        //     url: "{{ route('danliris_permintaan.create') }}",
        //     type: "GET",
        //     dataType: "json",
        //     success: function(response)
        //     {
        //         if(response.status == 200)
        //         {
        //             $.each(response.categories, function(index, categories) {
        //                 $('select[name="category_id"]').append('<option value="'+categories.id+'">'+categories.category_type+' - '+categories.category_name+'</option>')
        //             })
                    
        //             $.each(response.assets, function(index, assets) {
        //                 $('select[name="asset_id"]').append('<option value="'+assets.id+'">'+assets.asset_name+'</option>')
        //             })
        //         }
        //     }
        // })

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

                // var category_id = [];
                // var asset_id = [];
                // var quantity = [];

                // for(var i=0; i<= quantity; i++)
                // {

                // }

                // $('#category_id').each(function () {
                //     category_id.push($(this).text())
                // })

                // $('#asset_id').each(function () {
                //     asset_id.push($(this).text())
                // })
                
                // $('#quantity').each(function () {
                //     quantity.push($(this).text())
                // })

                var requestData = {
                    'date': $('#date').val(),
                    'username': $('#username').val(),
                    'division_id': $('#division_id').val(),
                    'company_id': $('#company_id').val(),
                    'category_id': $('#category_id').val(),
                    'asset_id': $('#asset_id').val(),
                    'quantity': $('#quantity').val(),
                    // 'category_id': JSON.stringify(category_id),
                    // 'asset_id': JSON.stringify(asset_id),
                    'unit_id': $('#unit_id').val(),
                    // 'quantity': JSON.stringify(quantity),
                    'description': $('#description').val(),
                }

                $.ajax({
                    method: "POST",
                    data: requestData,
                    url: "{{ route('danliris_permintaan.store') }}",
                    // dataType:'json',
                    // contentType: 'application/json; charset=utf-8',
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    // async: false,
                    beforeSend: function()
                    {
                        console.log(requestData)
                    },
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
                url: "{{ route('danliris_permintaan.index') }}" + '/' + id + '/edit',
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
                        // $('#updatePermintaan').find('#date').datepicker({
                        //     format: 'dd-mm-yyyy',
                        //     autoclose: true,
                        //     locale: 'en'
                        // });
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

                        $('#updatePermintaan').find('#date').val(response.danliris_permintaans.date);
                        $('#updatePermintaan').find('#username').val(response.danliris_permintaans.username);

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

                        $('#updatePermintaan').find('#quantity').val(response.danliris_permintaans.quantity);
                        $('#updatePermintaan').find('#description').val(response.danliris_permintaans.description);
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
                url: "/danliris_permintaan/" + id,
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
                    url: "danliris_permintaan/" + id,
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
