@extends('template.layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h2 class="mb-4">Stock Opname</h2>

                       
                     
                            {{-- notifikasi form validasi --}}
                            @if ($errors->has('file'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                            @endif
                     
                            <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
                                Upload Excel
                            </button>
                     
                            <!-- Import Excel -->
                            <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('ag_stockopname.import') }}" enctype="multipart/form-data">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload Excel</h5>
                                            </div>
                                            <div class="modal-body">
                     
                                                {{ csrf_field() }}
                     
                                                <label>Pilih file excel</label>
                                                <div class="form-group">
                                                    <input type="file" name="file" required="required">
                                                </div>
                     
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                     
                            <br><br>
                            @csrf
                            <table class='table table-bordered datatables'>
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>User</th>
                                        <th>Nama Barang</th>
                                        <th>Pabrikan</th>
                                        <th>Merk</th>
                                        <th>Processor</th>
                                        <th>Power Supply</th>
                                        <th>Casing</th>
                                        <th>HDD 1</th>
                                        <th>HDD 2</th>
                                        <th>Ram 1</th>
                                        <th>Ram 2</th>
                                        <th>Fan Processor</th>
                                        <th>Dvd Internal</th>
                                        <th>IP</th>
                                        <th>Perusahaan</th>
                                        <th>Divisi</th>
                                        <th>Unit</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                    </div>
                </div>
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
                ajax: "{{ route('ag_stockopname.index') }}",
                method: 'GET',
                // type: "GET",
                // url: "{{ route('permintaan.index') }}" + '/' + 'getDanliris',
                destroy: true,
                columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '5%'},
                        {data: 'username', name: 'username', width: '15%'},
                        {data: 'nama_barang', name: 'nama_barang', width: '15%'},
                        {data: 'manufacture', name: 'manufacture', width: '15%'},
                        {data: 'merk', name: 'merk', width: '15%'},
                        {data: 'processor', name: 'processor', width: '15%'},
                        {data: 'power_supply', name: 'power_supply', width: '15%'},
                        {data: 'casing', name: 'casing', width: '15%'},
                        {data: 'hddslot1', name: 'hddslot1', width: '15%'},
                        {data: 'hddslot2', name: 'hddslot2', width: '15%'},
                        {data: 'ramslot1', name: 'ramslot1', width: '15%'},
                        {data: 'ramslot2', name: 'ramslot2', width: '15%'},
                        {data: 'fan_processor', name: 'fan_processor', width: '15%'},
                        {data: 'dvd_internal', name: 'dvd_internal', width: '15%'},
                        {data: 'asset_ip', name: 'asset_ip', width: '15%'},
                        {data: 'company', name: 'company', width: '15%'},
                        {data: 'divisi', name: 'divisi', width: '15%'},
                        {data: 'unit', name: 'unit', width: '15%'},
                        {data: 'location', name: 'location', width: '15%'},
                        {data: 'status', name: 'status', width: '15%'},
                        // {data: 'action', name: 'action', width: '5%'},
                    ],
                    order: [
                        [0, 'desc'],
                    ],
            });
        })

    </script>
  

@endsection